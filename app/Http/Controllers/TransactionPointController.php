<?php

namespace App\Http\Controllers;

use App\Exports\TransactionPointExport;
use App\Models\TransactionPoint;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionPointController extends Controller
{
    public function createNewTransaction($userId, $courseId)
    {

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

    public function export()
    {
        return Excel::download(new TransactionPointExport, 'transaction-points.xlsx');
    }
}
