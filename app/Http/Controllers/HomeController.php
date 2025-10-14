<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Transactions;
use App\Models\User;

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
        $courses = Course::all();
        $user = optional(Auth::user())->role;
        $donation = Transactions::sum('amount');
        $usedPoint = User::where('role', 'tutor')->sum('point') * 10000;
        $percentage = $donation > 0 ? ($usedPoint / $donation) * 100 : 0;
        
        $formattedTotal = 'Rp ' . number_format($donation, 2, ',', '.');
        $formattedUsed = 'Rp ' . number_format($usedPoint, 2, ',', '.');
        if($user === 'Donator'){
            return view('home.donator', compact('formattedTotal', 'formattedUsed', 'percentage', 'donation', 'usedPoint'));
        }
        else if ($user === 'Tutor') {
            return view('home.tutor', compact('courses'));
        } else {
            return view('home.tutee', compact('courses'));
        }
    }
}
