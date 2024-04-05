<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/backRoute', [AuthController::class, 'loadLogin']);

Route::get('/index',[FrontEndController::class,'index']);

//login-logout
Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/login',[AuthController::class,'loadLogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

//forgot-password

Route::get('/forgot',[AuthController::class,'loadForgot']);

Route::post('/forgot',[Authcontroller::class,'forgot'])->name('forgot');
Route::get('/reset/{email}/{token}',[AuthController::class,'getReset']);

Route::post('/reset/{email}/{token}',[AuthController::class,'postReset']);


//Admin
Route::group(['prefix' => '_admin', 'middleware' => ['web', 'isAdmin']], function () {
    //users
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/edit_users/{id}', [AdminController::class, 'edit_users']);
    Route::post('/edit_users/{id}', [AdminController::class, 'update_users']);
    Route::get('/delete_users/{id}', [AdminController::class, 'delete_users']);

    //roles
    Route::get('/roles', [AdminController::class, 'roles']);
    Route::post('/edit_roles/{id}', [AdminController::class, 'edit_roles']);

    //blocks
    Route::get('/blocks', [AdminController::class, 'blocks']);
    Route::get('/add_blocks', [AdminController::class, function (){
        return view('control.admin.add_blocks');
    }]);
    Route::post('/add_blocks', [AdminController::class, 'add_blocks']);
    Route::get('/edit_blocks/{id}', [AdminController::class,'edit_blocks']);
    Route::post('/edit_blocks/{id}', [AdminController::class,'update_blocks']);
    Route::get('/delete_blocks/{id}', [AdminController::class,'delete_blocks']);

    //departments
    Route::get('/departments', [AdminController::class, 'departments']);
    Route::get('/show_departments',[AdminController::class, 'show_departments']);
    Route::post('/add_departments',[AdminController::class, 'add_departments']);
    Route::get('/edit_departments/{id}',[AdminController::class,'edit_departments']);
    Route::post('/edit_departments/{id}',[AdminController::class,'update_departments']);
});

//Pharmacist
Route::group(['prefix' => '_pharmacist', 'middleware' => ['web', 'isPharmacist']], function () {
    Route::get('/dashboard', [PharmacistController::class, 'dashboard']);
});
//Doctor
Route::group(['prefix' => '_doctor', 'middleware' => ['web', 'isDoctor']], function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard']);
});
//User
Route::group(['prefix' => '_user', 'middleware' => ['web', 'isUser']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
});


Route::get('/insert',[AuthController::class,'insert']);

