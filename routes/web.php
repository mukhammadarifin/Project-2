<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
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

//route for login control
Route::get('/', [AuthController::class, 'index']);
Route::post('proses_login', [AuthController::class, 'proses_login']);
Route::get('logout', [AuthController::class, 'logout']);

//route group for admin
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => 'cek_login:admin'], function () {

        //admin home Dashboard
        Route::get('admin', [AdminController::class, 'index']);

        //admin for Mahasiswa
        Route::get('adminpagemahasiswa', [AdminController::class, 'allmahasiswa']);

        //admin for Dosen
        Route::get('adminpagedosen', [AdminController::class, 'alldosen']);

        //admin for Admin
        Route::get('adminpageadmin', [AdminController::class, 'alladmin']);



        //admin CRUD for User account
        //create post
        Route::get('admincreateuser',[AdminController::class, 'create']);
        Route::post('adminstoreuser',[AdminController::class, 'store']);

        //update
        Route::post('adminedituser',[AdminController::class, 'edit']);
        Route::patch('adminupdateuser',[AdminController::class, 'update']);
    });
});

//route group for mahasiswa
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => 'cek_login:mahasiswa'], function () {
        Route::get('siswa', [SiswaController::class, 'index']);
    });
});
