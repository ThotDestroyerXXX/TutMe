<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.page');
});

Route::get('/tutor', function () {
    return view('home.page');
});

Route::get('/course', function () {
    return view('home.page');
});

Route::get('/funding', function () {
    return view('home.page');
});

Route::get('/learning-history', function () {
    return view('home.page');
});

Route::get('/transaction-log', function () {
    return view('home.page');
});

Route::get('/login', function () {
    return view('home.page');
});

Route::get('/register', function () {
    return view('home.page');
});

Route::get('/profile', function () {
    return view('home.page');
});

Route::fallback(function (){
    return view("not-found");
});

Route::redirect("logout", "login");

Route::get('/about', function () {
    return view('home.page');
});