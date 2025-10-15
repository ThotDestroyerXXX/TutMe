<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Course CRUD
Route::get('/course/{id?}', [HomeController::class, 'viewCourse'])->name('course');
Route::match(['post', 'put'], '/courses/{id?}', [HomeController::class, 'saveCourse'])->name('saveCourse');
Route::delete('/course/delete/{id}', [CourseController::class, 'delete'])->name('course.delete');


Route::post('/donate', [TransactionsController::class, 'createTransaction'])->name('transaction.donate');
Route::get('/transactions/store', [TransactionsController::class, 'store'])->name('transactions.store');
