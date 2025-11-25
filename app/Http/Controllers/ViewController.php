<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\TransactionPoint;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

class ViewController extends Controller
{
    protected $viewMap = [
        'Tutee' => 'home.tutee',
        'Mentor' => 'home.tutor',
        'Donator' => 'home.donator',
    ];

    public function Dashboard($role)
    {
        $view = $this->viewMap[$role] ?? 'home.tutee';

        $courses = App(CourseController::class)->getAllCourse();

        $courses = Course::whereNotIn('id', function ($query) {
            $query->select('course_id')
                ->from('enrollments')
                ->where('user_id', Auth::id());
        })->get();

        $data = [
            'courses' => $courses,
            'coursesById' => App(CourseController::class)->getCoursesById(Auth::id()),
        ];

        if ($role === 'Donator') {
            $data = array_merge($data, App(UserController::class)->getDonatorData());
        }

        return view($view, $data);
    }

    public function viewCourse($id = null)
    {
        $data = $id ? App(CourseController::class)->getCourseById($id) : null;

        return view('course.createCourse', compact('data'));
    }

    public function selectCourse(Request $request, $idCourse, $idUser = null)
    {        
        $data = $idCourse ? App(CourseController::class)->getCourseById($idCourse) : null;
        if($idUser == null){        
            return view('course.selectCourse', compact('data'));
        }else{
            App(EnrollmentController::class)->enrollCourse($request, $idCourse, $idUser);
            return redirect()->route('home', ['role' => Auth::user()->role]);
        }
    }

    public function getEnrollmentDetail($id){
        $enrollData = App(EnrollmentController::class)->getEnrollmentById($id);
        $course = App(CourseController::class)->getCourseById($enrollData->course_id);
        $data = [
            'enrollment' => $enrollData,
            'tutee' => App(UserController::class)->getUserById($enrollData->user_id),
            'course' => $course,
            'mentor' => App(UserController::class)->getUserById($course->instructor_id),
        ];

        return view('enrollment.detail', $data) ;
    }

    public function acceptEnrollment($id, $bool){
        $data = App(EnrollmentController::class)->getEnrollmentById($id);
        if($bool === 'true'){
            $data->status = 'ACTIVE';
        } else{
            $data->status = 'REJECTED';
            $data->point_spent = 0;
            App(UserController::class)->mentorRejected($data->user_id);
        }
        $data->save();
        return redirect()->route('home', ['role' => Auth::user()->role]);
    }

    public function finishMentoring($id, $userId){
        $user = App(UserController::class)->getUserById($userId);
        $data = App(EnrollmentController::class)->getEnrollmentById($id);
        if($user->role === 'Mentor'){
            $data->status = 'DONE';
        }else{
            $user->point += 25;
            App(TransactionPointController::class)->createNewTransaction($userId, $data->course_id);
        }
        $user->save();
        $data->save();
        
        return redirect()->route('home', ['role' => Auth::user()->role]);
    }
}