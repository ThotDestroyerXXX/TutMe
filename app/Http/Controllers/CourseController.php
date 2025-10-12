<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    public function create($id = null)
    {
        $course = $id ? Course::findOrFail($id) : null;
        return view('createCourse.createCourse', compact('course'));
    }

    public function store(Request $request)
    {
        // CREATE NEW COURSE
        $validated = $request->validate([
            'subject' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'topics' => 'required|array|min:1|max:4',
            'session' => 'required|integer',
            'level' => 'required|integer',
        ]);

        $course = new Course();
        $course->subject = $validated['subject'];
        $course->title = $validated['title'];
        $course->topics = json_encode($validated['topics']);
        $course->session = $validated['session'];
        $course->level = $validated['level'];
        $course->instructor_id = Auth::id();
        $course->image = strtolower($validated['subject']) . ".png";
        $course->is_active = true;
        $course->save();

        return redirect()->route('home')->with('success', 'Course created successfully!');
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->is_active = $request->has('is_active');
        $course->save();

        return redirect()->route('home')->with('success', 'Course updated successfully!');
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('home')->with('success', 'Course deleted successfully!');
    }
}
