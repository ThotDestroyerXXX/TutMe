<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

        $data = [
            'courses' => App(CourseController::class)->getAllCourse(),
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