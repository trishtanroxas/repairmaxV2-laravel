<?php

use Illuminate\Support\Facades\Route;

//Landing Page
Route::get('/', function () {
    return view('welcome');
});
Route::get('/about-us', function () {
    return view('about-us');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/repairs', function () {
    return view('repairs');
});
Route::get('/faq', function () {
    return view('faq');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/legal-policy', function () {
    return view('legal-policy');
});
