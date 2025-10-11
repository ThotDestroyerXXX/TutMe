<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/tutor', function () {
//     return view('home.page');
// });

// Route::get('/course', function () {
//     return view('home.page');
// });

// Route::get('/funding', function () {
//     return view('home.page');
// });

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

// Route::redirect("logout", "login");

// Route::get('/about', function () {
//     return view('home.page');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/newCourse', [CourseController::class, 'create'])->name('newCourse');

Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');