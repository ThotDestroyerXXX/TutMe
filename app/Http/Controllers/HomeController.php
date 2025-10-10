<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::all();
        $user = optional(Auth::user())->role;
        if($user === 'donatur'){
            return view('home.tutee');
        }
        else if ($user === 'Tutor') {
            return view('home.tutor');
        } else {
            return view('home.tutee', compact('courses'));
        }
    }
}
