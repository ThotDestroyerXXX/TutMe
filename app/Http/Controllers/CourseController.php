<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all(); // ambil semua data dari tabel courses
        return view('home.home', compact('courses'));
    }
}
