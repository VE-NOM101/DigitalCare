<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PdfGenerator;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Models\Doctor;

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
    return view('control.user.appointment_card');
});


Route::get('/backRoute', [AuthController::class, 'loadLogin']);

Route::get('/index', [FrontEndController::class, 'index']);


//login-logout
Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'loadLogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

//forgot-password

Route::get('/forgot', [AuthController::class, 'loadForgot']);
Route::post('/forgot', [Authcontroller::class, 'forgot'])->name('forgot');
Route::get('/reset/{email}/{token}', [AuthController::class, 'getReset']);
Route::post('/reset/{email}/{token}', [AuthController::class, 'postReset']);

//frontend interaction
Route::post('/request_appointment', [UserController::class, 'request_appointment']);

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
    Route::get('/add_blocks', [AdminController::class, function () {
        return view('control.admin.add_blocks');
    }]);
    Route::post('/add_blocks', [AdminController::class, 'add_blocks']);
    Route::get('/edit_blocks/{id}', [AdminController::class, 'edit_blocks']);
    Route::post('/edit_blocks/{id}', [AdminController::class, 'update_blocks']);
    Route::get('/delete_blocks/{id}', [AdminController::class, 'delete_blocks']);

    //departments
    Route::get('/departments', [AdminController::class, 'departments']);
    Route::get('/show_departments', [AdminController::class, 'show_departments']);
    Route::post('/add_departments', [AdminController::class, 'add_departments']);
    Route::get('/edit_departments/{id}', [AdminController::class, 'edit_departments']);
    Route::post('/edit_departments/{id}', [AdminController::class, 'update_departments']);
    Route::get('/delete_departments/{id}', [AdminController::class, 'delete_departments']);

    //doctors
    Route::get('/doctors', [AdminController::class, 'doctors']);
    Route::post('/add_doctors', [AdminController::class, 'add_doctors']);
    Route::get('/delete_doctors/{id}', [AdminController::class, 'delete_doctors']);
    Route::get('/appointments', [AdminController::class, 'appointments']);
    Route::get('/cancel_appointment/{id}',[AdminController::class,'cancel_appointment']);
    Route::get('/confirm_appointment/{id}',[AdminController::class,'confirm_appointment']);
    Route::post('/confirm_appointment/{approved_id}',[AdminController::class,'post_confirm_appointment']);
    //nurses
    Route::get('/nurses', [AdminController::class, 'nurses']);
    Route::post('/add_nurses', [AdminController::class, 'add_nurses']);
    Route::get('/delete_nurses/{id}', [AdminController::class, 'delete_nurses']);
});

//Pharmacist
Route::group(['prefix' => '_pharmacist', 'middleware' => ['web', 'isPharmacist']], function () {
    Route::get('/dashboard', [PharmacistController::class, 'dashboard']);

    Route::get('/medicines',[PharmacistController::class,'medicines']);
});
//Doctor
Route::group(['prefix' => '_doctor', 'middleware' => ['web', 'isDoctor']], function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard']);
    Route::get('/profile', [DoctorController::class, 'profile']);
    Route::post('/edit_profile/{doctor_id}/{user_id}', [DoctorController::class, 'edit_profile']);
    Route::post('/change_password/{user_id}', [DoctorController::class, 'change_password']);
   
    Route::get('/schedule',[DoctorController::class,'schedule']);
    Route::post('/update_schedule/{id}',[DoctorController::class,'update_schedule']);

    Route::get('/appointments', [DoctorController::class, 'appointments']);
    Route::post('/approve_appointment/{id}/', [DoctorController::class, 'approve_appointment']);
    Route::get('/cancel_appointment/{id}',[DoctorController::class,'cancel_appointment']);
    Route::get('/visited/{id}',[DoctorController::class,'visited']);
    // Route for searching users by email
    Route::get('/search_users', [DoctorController::class,'search_users']);


    //add new patient
    Route::get('/add_new_patient',[DoctorController::class,'add_new_patient']);
    Route::post('/add_new_patient',[DoctorController::class,'post_add_new_patient']);

    Route::get('/patient_list',[DoctorController::class,'patient_list']);
    Route::get('/view_patient/{id}',[DoctorController::class,'view_patient']);
    Route::get('/attach_patient/{id}',[DoctorController::class,'attach_patient']);
    Route::get('/edit_patient/{id}',[DoctorController::class,'edit_patient']);
    Route::post('/update_patient/{id}',[DoctorController::class,'update_patient']);
    Route::get('/detach_patient/{id}',[DoctorController::class,'detach_patient']);

    Route::get('/diagnosis',[DoctorController::class,'diagnosis']);
    Route::get('/add_diagnosis',[DoctorController::class,'add_diagnosis']);
    Route::post('/add_diagnosis',[DoctorController::class,'post_add_diagnosis']);
    Route::get('/edit_diagnosis/{id}',[DoctorController::class,'edit_diagnosis']);
    Route::post('/update_diagnosis/{id}',[DoctorController::class,'update_diagnosis']);
    Route::get('/delete_diagnosis/{id}',[DoctorController::class,'delete_diagnosis']);

    Route::get('/prescription',[DoctorController::class,'prescription']);
    Route::get('/get_patient_appointments', [DoctorController::class,'get_patient_appointments']);
});
//Nurse
Route::group(['prefix' => '_nurse', 'middleware' => ['web', 'isNurse']], function () {
    Route::get('/dashboard', [NurseController::class, 'dashboard']);
    Route::get('/profile', [NurseController::class, 'profile']);
    Route::post('/edit_profile/{nurse_id}', [NurseController::class, 'edit_profile']);
    Route::post('/change_password/{user_id}', [NurseController::class, 'change_password']);
});
//User
Route::group(['prefix' => '_user', 'middleware' => ['web', 'isUser']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/appointments',[UserController::class, 'appointments']);
    Route::get('/resend_appointment/{id}',[UserController::class, 'resend_appointment']); 
    Route::post('/post_resend_appointment',[UserController::class, 'post_resend_appointment']);
    Route::get('/generateAppointmentCard/{id}',[PdfGenerator::class,'generateAppointmentCard']);

    Route::get('/patient_profile',[UserController::class,'patient_profile']);
    Route::get('/add_profile_picture/{id}',[UserController::class,'add_profile_picture']);
    Route::post('/add_profile_picture/{id}',[UserController::class,'post_add_profile_picture']);
});


Route::get('/insert', [AuthController::class, 'insert']);
