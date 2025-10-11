<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all(); 
    }

    public function create(){
        return view('createCourse.createCourse');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'subject' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'topics' => 'required|array|min:1|max:4',
            'session' => 'required|integer',
            'level' => 'required|integer',
        ]);

        // Simpan ke database
        $course = new Course();
        $course->subject = $validated['subject'];
        $course->title = $validated['title'];
        $course->topics = json_encode($validated['topics']); // simpan array jadi JSON
        $course->session = $validated['session'];
        $course->level = $validated['level'];
        $course->instructor_id = Auth::id()
        ;$course->image = strtolower($validated['subject']) . ".png";


        $course->save();

        return redirect()->route('newCourse')->with('success', 'Course berhasil dibuat!');
    }
}