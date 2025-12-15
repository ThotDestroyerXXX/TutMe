<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Http\Controllers\Exception;
use Carbon\Traits\ToStringFormat;

class EnrollmentController extends Controller
{
    public function enrollCourse(Request $request, $idCourse, $idUser = null){
        try
        {
            $data = new Enrollment([
                'user_id' => $idUser,
                'course_id' => $idCourse,
                'point_spent' => App(CourseController::class)->getCourseById($idCourse)->session * 25,
                'status' => 'PENDING',
                'date' => $request->input('date'),
            ]);
            
            if(!App(UserController::class)->userEnrolled($idCourse, $idUser)){
                throw new \Exception('Poin user tidak mencukupi untuk enroll course ini.');
            }else{
                $data->save();
            }
        } 
        catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getEnrollmentById($id){
        return Enrollment::findOrFail($id);
    }

    public function getPointSpent($id){
        $datas = Enrollment::where('user_id', $id)->sum('point_spent');
        return $datas;
    }
}
