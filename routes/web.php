<?php

use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
//use App\Models\Enrollment;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class,'index']);
Route::post('login/',[LoginController::class,'login']);
Route::get('/home',[LoginController::class,'home']);
Route::get('/enrollment',[EnrollmentController::class,'index']);
Route::post('/enrollment',[EnrollmentController::class,'enrollment']);
Route::get('/edit/{id}',[EnrollmentController::class,'edit'])->name('enrollment.edit');
Route::post('update_enrollment/{id}',[EnrollmentController::class,'update']);
Route::get('delete/{id}',[EnrollmentController::class,'delete'])->name('enrollment.delete');
Route::get('/logout',[LoginController::class,'logout']);
Route::get('/state',[EnrollmentController::class,'get_state']);
Route::get('/city',[EnrollmentController::class,'get_city']);
Route::get('get-enrollment',[EnrollmentController::class,'get_enrollment']);
Route::get('/country/{id}',[EnrollmentController::class,'get_country']);