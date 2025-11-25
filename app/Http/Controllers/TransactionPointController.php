<?php

namespace App\Http\Controllers;

use App\Models\TransactionPoint;
use Illuminate\Http\Request;

class TransactionPointController extends Controller
{
    public function createNewTransaction($userId, $courseId){

        $data = new TransactionPoint([
            'user_id' => $userId,
            'amount' => 25,
            'course_id' => $courseId,
        ]);

        $mentor = App(UserController::class)->getUserById(App(CourseController::class)->getCourseById($courseId)->instructor_id);
        $mentor->point += 25;
        $mentor->save();
        $data->save();
    }
}
