<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function getAllCourse()
    {
        return Course::All();
    }

    public function getCourseById($id)
    {
        return Course::findOrFail($id) ? Course::findOrFail($id) : null;
    }

    public function getCoursesById($userId)
    {
        if (App(UserController::class)->getUserRole() == 'Mentor') {
            return Course::join('enrollments', 'courses.id', '=', 'enrollments.course_id')
                ->where('instructor_id', $userId)
                ->orderBy('enrollments.date', 'desc')
                ->select(
                    'enrollments.id as enrollment_id',
                    'enrollments.status',
                    'enrollments.point_spent',
                    'enrollments.grade',
                    'enrollments.recording',
                    'enrollments.date',
                    'enrollments.user_id',
                    'enrollments.course_id',
                    'courses.id',
                    'courses.level',
                    'courses.subject',
                    'courses.title',
                    'courses.session',
                    'courses.image',
                    'courses.instructor_id',
                    'courses.topics',
                    'courses.start_time',
                    'courses.end_time',
                    'courses.meet_link',
                    'courses.day',
                    'courses.is_active'
                )->get();
        } else {
            return Course::join('enrollments', 'courses.id', '=', 'enrollments.course_id')
                ->where('enrollments.user_id', $userId)
                ->orderBy('enrollments.date', 'desc')
                ->select(
                    'enrollments.id as enrollment_id',
                    'enrollments.status',
                    'enrollments.point_spent',
                    'enrollments.grade',
                    'enrollments.recording',
                    'enrollments.date',
                    'enrollments.user_id',
                    'enrollments.course_id',
                    'courses.id',
                    'courses.level',
                    'courses.subject',
                    'courses.title',
                    'courses.session',
                    'courses.image',
                    'courses.instructor_id',
                    'courses.topics',
                    'courses.start_time',
                    'courses.end_time',
                    'courses.meet_link',
                    'courses.day',
                    'courses.is_active'
                )->get();
        }
    }

    public function saveCourse(Request $request, $id = null)
    {
        if ($id) {
            $data = Course::findOrFail($id);
            $data->is_active = $request->has('is_active');
        } else {
            $startTime = Carbon::parse($request->input('timeInput'));
            $endTime = $startTime->copy()->addMinutes((60 * (int) $request->input('session')));
            $data = new Course([
                'subject' => $request['subject'],
                'title' => $request['title'],
                'topics' => json_encode($request['topics']),
                'session' => $request['session'],
                'level' => $request['level'],
                'instructor_id' => Auth::id(),
                'image' => strtolower($request['subject']) . ".png",
                'start_time' => $startTime,
                'end_time' => $endTime,
                'meet_link' => $request['link'],
                'day' => json_encode($request->input('day')),
                'is_active' => true,
            ]);
        }

        $data->save();
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('home')->with('success', 'Course deleted successfully!');
    }
}
