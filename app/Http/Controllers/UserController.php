<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function getUserRole(){
        return Auth::user() ? Auth::user()->role : 'Tutee';
    }

    public function getAllTutor(){
        return User::where('role', 'tutor')->get();
    }

    public function getUsedPoint(){
        $tutors = $this->getAllTutor();
        $usedPoint = $tutors->sum('point') * 10000;
        return $usedPoint;
    }

    public function getDonatorData()
    {
        return [
            'formattedTotal' => 'Rp ' . number_format(App(TransactionsController::class)->getSumTransaction(), 2, ',', '.'),
            'formattedUsed'  => 'Rp ' . number_format(App(UserController::class)->getUsedPoint(), 2, ',', '.'),
            'percentage'     => App(TransactionsController::class)->getTransactionPersentage(),
            'donation'       => App(TransactionsController::class)->getSumTransaction(),
            'usedPoint'      => App(UserController::class)->getUsedPoint(),
        ];
    }
}