<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\TypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/users',[UserController::class,'index'])->name('users');
Route::get('/create',[UserController::class,'create'])->name('user-create');
Route::post('/store', [UserController::class, 'store'])->name('user-store');
Route::post('/update/user-info/{id}', [UserController::class,'updateUserInfo'])->name('update-user-info'); 






Route::get('/', function () {
    return view('welcome');
});

Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/home',[AuthController::class,'index'])->name('home');


Route::get('/designation',[DesignationController::class,'index'])->name('designation');
Route::post('/store-designation',[DesignationController::class,'store'])->name('store-designation');
Route::get('/edit-designation/{id}',[DesignationController::class,'edit'])->name('edit-designation');
Route::get('/delete-designation/{id}',[DesignationController::class,'delete'])->name('delete-designation');
Route::post('update-designation',[DesignationController::class,'update'])->name('update-designation');

Route::get('/type',[TypeController::class,'index'])->name('type');
Route::post('/store-type',[TypeController::class,'store'])->name('store-type');
Route::get('/edit-type/{id}',[TypeController::class,'edit'])->name('edit-type');
Route::post('/update-type',[TypeController::class,'update'])->name('update-type');
Route::get('/delete-type/{id}',[TypeController::class,'delete'])->name('delete-type');

Route::group(['middleware'=>'loginCheck'],function(){
	Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});