<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
        return App(ViewController::class)->Dashboard(App(UserController::class)->getUserRole());
    }

    public function viewCourse($id = null)
    {
        return App(ViewController::class)->viewCourse($id);
    }

    public function saveCourse(Request $request, $id = null)
    {
        App(CourseController::class)->saveCourse($request, $id);
        return $this->index();
    }

    public function selectCourse(Request $request, $idCourse, $idUser = null){
        return App(ViewController::class)->selectCourse($request, $idCourse, $idUser);
    }

    public function getEnrollmentDetail($id){
        return App(ViewController::class)->getEnrollmentDetail($id);
    }

    public function acceptEnrollment($id, $bool){
        App(ViewController::class)->acceptEnrollment($id, $bool);
        return App(HomeController::class)->index();    
    }

    public function finishMentoring($id, $userId){
        return App(ViewController::class)->finishMentoring($id, $userId);
    }

    public function viewMyPoint($id){
        return $id ? App(ViewController::class)->viewMyPoint($id) : App(ViewController::class)->Dashboard('guess');
    }
}
