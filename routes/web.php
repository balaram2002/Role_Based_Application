<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\RoleUser;

Route::get('/', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('registerpage');
});


Route::view('login','login')->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/show',[Usercontroller::class,'dashboardPage'])->name('dashboard');
Route::post('/login',[Usercontroller::class,'login']);
Route::get('/logout',[Usercontroller::class,'logout'])->name('logout');
Route::post('/show',[Usercontroller::class,'updateDetails'])->name('show');
Route::get('/alluserdetails',[Usercontroller::class,'alluser'])->name('all');
Route::put('/update-role/{id}', [UserController::class, 'updateRole']);
Route::post('/assign-user-to-coach/{coachId}', [UserController::class, 'assignUserToCoach']);
Route::get('/coach', [UserController::class, 'showCoaches']);
Route::get('/my-users', [UserController::class, 'myUsers'])->name('my.users');

