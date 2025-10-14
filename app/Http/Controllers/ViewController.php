<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    protected $viewMap = [
        'Tutee' => 'home.tutee',
        'Tutor' => 'home.tutor',
        'Donator' => 'home.donator',
    ];

    public function Dashboard($role)
    {
        $view = $this->viewMap[$role] ?? 'home.tutee';

        $data = [
            'courses' => App(CourseController::class)->getAllCourse(),
        ];

        if ($role === 'Donator') {
            $data = array_merge($data, App(UserController::class)->getDonatorData());
        }

        return view($view, $data);
    }
}