<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    protected $viewMap = [
        'Tutee' => 'home.tutee',
        'Tutor' => 'home.tutor',
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
}