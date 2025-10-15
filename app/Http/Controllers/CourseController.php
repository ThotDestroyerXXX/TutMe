<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    public function create($id = null)
    {
        return $id ? Course::findOrFail($id) : null;
    }

    public function getAllCourse(){
        return Course::All();
    }

    public function getCourseById($id){
        return Course::findOrFail($id) ? Course::findOrFail($id) : null;
    }

    public function saveCourse(Request $request, $id = null){
        if($id){
            $data = Course::findOrFail($id);
            $data->is_active = $request->has('is_active');
        }else{
            $data = new Course([
                'subject' => $request['subject'],
                'title' => $request['title'],
                'topics' => json_encode($request['topics']),
                'session' => $request['session'],
                'level' => $request['level'],
                'instructor_id' => Auth::id(),
                'image' => strtolower($request['subject']) . ".png",
                'is_active' => true,
            ]); 
        }
        
        $data->save();
    }

    // public function store(Request $request)
    // {
    //     // CREATE NEW COURSE

    //     $course = new Course();
    //     $course->subject = $validated['subject'];
    //     $course->title = $validated['title'];
    //     $course->topics = json_encode($validated['topics']);
    //     $course->session = $validated['session'];
    //     $course->level = $validated['level'];
    //     $course->instructor_id = Auth::id();
    //     $course->image = strtolower($validated['subject']) . ".png";
    //     $course->is_active = true;
        

    //     return redirect()->route('home')->with('success', 'Course created successfully!');
    // }

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
