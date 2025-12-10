<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TransactionPointController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

// Route::get('/learning-history', function () {
//     return view('home.page');
// });

// Route::get('/transaction-log', function () {
//     return view('home.page');
// });

// Route::get('/profile', function () {
//     return view('home.page');
// });

// Route::fallback(function (){
//     return view("not-found");
// });


//Main Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// mentor middleware
Route::middleware('role:Mentor')->group(function () {

    // course route
    Route::match(['post', 'put'], '/courses/{id?}', [HomeController::class, 'saveCourse'])->name('saveCourse');
    Route::delete('/course/delete/{id}', [CourseController::class, 'delete'])->name('course.delete');

    // enrollment route
    Route::get('/acceptEnrollment/{id}/{bool}', [HomeController::class, 'acceptEnrollment'])->name('acceptEnrollment');
    Route::get('/finishMentoring/{id}/{userId}', [HomeController::class, 'finishMentoring'])->name('finishMentoring');
});

// tutee middleware
Route::middleware('role:Tutee')->group(function () {

    // enrollment route
    Route::get('/selectCourse/{id}', [HomeController::class, 'selectCourse'])->name('selectCourse');
    Route::post('/enrollCourse/{idCourse}/{idUser}', [HomeController::class, 'selectCourse'])->name('enrollCourse');
});

// mentor and tutee middleware
Route::middleware('role:Mentor,Tutee')->group(function () {

    // course route
    Route::get('/course/{id?}', [HomeController::class, 'viewCourse'])->name('course');

    // enrollment route
    Route::get('/enrollmentDetail/{id}', [HomeController::class, 'getEnrollmentDetail'])->name('enrollmentDetail');
});

//Donator middleware
Route::middleware('role:Donator')->group(function () {

    Route::post('/donate', [TransactionsController::class, 'createTransaction'])->name('transaction.donate');
    Route::get('/transactions/store', [TransactionsController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/export', [TransactionsController::class, 'export'])->name('transactions.export');
    Route::get('/transaction-points/export', [TransactionPointController::class, 'export'])->name('transactionPoints.export');
});

// guest middleware
Route::middleware('guest')->group(function () {

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');
});

// auth middleware
Route::middleware('auth')->group(function () {

    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::get('locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale.set');
