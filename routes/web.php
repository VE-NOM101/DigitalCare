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
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SslCommerzPaymentController;
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

Route::get('/index', [FrontEndController::class, 'index'])->name('index');


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
    Route::get('/cancel_appointment/{id}', [AdminController::class, 'cancel_appointment']);
    Route::get('/confirm_appointment/{id}', [AdminController::class, 'confirm_appointment']);
    Route::post('/confirm_appointment/{approved_id}', [AdminController::class, 'post_confirm_appointment']);
    //nurses
    Route::get('/nurses', [AdminController::class, 'nurses']);
    Route::post('/add_nurses', [AdminController::class, 'add_nurses']);
    Route::get('/delete_nurses/{id}', [AdminController::class, 'delete_nurses']);

    Route::get('/pharmacists', [AdminController::class, 'pharmacists']);
    Route::post('/add_pharmacists', [AdminController::class, 'add_pharmacists']);
    Route::get('/delete_pharmacists/{id}', [AdminController::class, 'delete_pharmacists']);

    //IPD Patient
    Route::get('/ipd_patient',[AdminController::class,'ipd_patient']);
    Route::post('/add_ipd_patient',[AdminController::class,'add_ipd_patient']);
    Route::get('/edit_ipd_patient/{id}',[AdminController::class,'edit_ipd_patient']);
    Route::post('/edit_ipd_patient/{id}',[AdminController::class,'post_edit_ipd_patient']);
    Route::get('/delete_ipd_patient/{id}',[AdminController::class,'delete_ipd_patient']);

    //Bad Management
    Route::get('/bed_management',[AdminController::class,'bed_management']);
    Route::post('/add_bed',[AdminController::class,'add_bed']);
    Route::get('/edit_bed/{id}',[AdminController::class,'edit_bed']);
    Route::post('/edit_bed/{id}',[AdminController::class,'post_edit_bed']);
    Route::get('/delete_bed/{id}',[AdminController::class,'delete_bed']);

    //Book ambulance
    Route::get('/book_ambulance',[AdminController::class,'book_ambulance']);
    Route::get('/show_map/{id}',[AdminController::class,'show_map']);
    Route::get('/confirm_ambulance/{id}',[AdminController::class,'confirm_ambulance']);
    Route::post('/confirm_ambulance/{id}',[AdminController::class,'post_confirm_ambulance']);
    
    //Ambulance
    Route::get('/ambulance',[AdminController::class,'ambulance']);
    Route::post('/add_ambulance',[AdminController::class,'add_ambulance']);
    Route::get('/edit_ambulance/{id}',[AdminController::class,'edit_ambulance']);
    Route::post('/edit_ambulance/{id}',[AdminController::class,'post_edit_ambulance']);
    Route::get('/delete_ambulance/{id}',[AdminController::class,'delete_ambulance']);
    Route::get('/release_ambulance/{id}',[AdminController::class,'release_ambulance']);

    //Campaign 
    Route::get('/campaign',[AdminController::class,'campaign']);
    Route::post('/add_campaign',[AdminController::class,'add_campaign']);
    Route::post('/toggle_campaign/{id}',[AdminController::class,'toggle_campaign']);
    Route::get('/publish_campaign/{id}',[AdminController::class,'publish_campaign']);

});

//Pharmacist
Route::group(['prefix' => '_pharmacist', 'middleware' => ['web', 'isPharmacist']], function () {
    Route::get('/dashboard', [PharmacistController::class, 'dashboard']);

    Route::get('/medicines', [PharmacistController::class, 'medicines']);
    Route::get('/add_medicine_category', [PharmacistController::class, 'add_medicine_category']);
    Route::post('/add_medicine_category', [PharmacistController::class, 'post_add_medicine_category']);
    Route::get('/edit_medicine_category/{id}', [PharmacistController::class, 'edit_medicine_category']);
    Route::post('/edit_medicine_category/{id}', [PharmacistController::class, 'update_medicine_category']);
    Route::get('/delete_medicine_category/{id}', [PharmacistController::class, 'delete_medicine_category']);

    Route::get('/add_medicine_brand', [PharmacistController::class, 'add_medicine_brand']);
    Route::post('/add_medicine_brand', [PharmacistController::class, 'post_add_medicine_brand']);
    Route::get('/edit_medicine_brand/{id}', [PharmacistController::class, 'edit_medicine_brand']);
    Route::post('/edit_medicine_brand/{id}', [PharmacistController::class, 'update_medicine_brand']);
    Route::get('/delete_medicine_brand/{id}', [PharmacistController::class, 'delete_medicine_brand']);

    Route::get('/add_medicine', [PharmacistController::class, 'add_medicine']);
    Route::post('/add_medicine', [PharmacistController::class, 'post_add_medicine']);

    Route::get('/buy_medicine', [PharmacistController::class, 'buy_medicine']);
    Route::post('/buy_medicine', [PharmacistController::class, 'post_buy_medicine']);
    Route::get('/view_medicine_purchase/{id}', [PharmacistController::class, 'view_medicine_purchase']);

    Route::get('/getMedicinePrices/{id}', [PharmacistController::class, 'getMedicinePrices']);
    Route::get('/profile', [PharmacistController::class, 'profile']);

    Route::post('/edit_profile/{id}', [PharmacistController::class, 'edit_profile']);
});
//Doctor
Route::group(['prefix' => '_doctor', 'middleware' => ['web', 'isDoctor']], function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard']);
    Route::get('/profile', [DoctorController::class, 'profile']);
    Route::post('/edit_profile/{doctor_id}/{user_id}', [DoctorController::class, 'edit_profile']);
    Route::post('/change_password/{user_id}', [DoctorController::class, 'change_password']);

    Route::get('/schedule', [DoctorController::class, 'schedule']);
    Route::post('/update_schedule/{id}', [DoctorController::class, 'update_schedule']);

    Route::get('/appointments', [DoctorController::class, 'appointments']);
    Route::post('/approve_appointment/{id}/', [DoctorController::class, 'approve_appointment']);
    Route::get('/cancel_appointment/{id}', [DoctorController::class, 'cancel_appointment']);
    Route::get('/visited/{id}', [DoctorController::class, 'visited']);
    // Route for searching users by email
    Route::get('/search_users', [DoctorController::class, 'search_users']);


    //add new patient
    Route::get('/add_new_patient', [DoctorController::class, 'add_new_patient']);
    Route::post('/add_new_patient', [DoctorController::class, 'post_add_new_patient']);

    Route::get('/patient_list', [DoctorController::class, 'patient_list']);
    Route::get('/view_patient/{id}', [DoctorController::class, 'view_patient']);
    Route::get('/attach_patient/{id}', [DoctorController::class, 'attach_patient']);
    Route::get('/edit_patient/{id}', [DoctorController::class, 'edit_patient']);
    Route::post('/update_patient/{id}', [DoctorController::class, 'update_patient']);
    Route::get('/detach_patient/{id}', [DoctorController::class, 'detach_patient']);

    Route::get('/diagnosis', [DoctorController::class, 'diagnosis']);
    Route::get('/add_diagnosis', [DoctorController::class, 'add_diagnosis']);
    Route::post('/add_diagnosis', [DoctorController::class, 'post_add_diagnosis']);
    Route::get('/edit_diagnosis/{id}', [DoctorController::class, 'edit_diagnosis']);
    Route::post('/update_diagnosis/{id}', [DoctorController::class, 'update_diagnosis']);
    Route::get('/delete_diagnosis/{id}', [DoctorController::class, 'delete_diagnosis']);

    Route::get('/prescription', [DoctorController::class, 'prescription']);
    Route::get('/get_patient_appointments', [DoctorController::class, 'get_patient_appointments']);
    Route::get('/add_new_prescription', [DoctorController::class, 'add_new_prescription']);
    Route::post('/add_new_prescription', [DoctorController::class, 'post_add_new_prescription']);
    Route::get('/view_prescription/{id}', [DoctorController::class, 'view_prescription']);
    Route::get('/edit_prescription/{id}', [DoctorController::class, 'edit_prescription']);
    Route::post('/edit_prescription/{id}', [DoctorController::class, 'update_prescription']);
    Route::get('/delete_prescription/{id}', [DoctorController::class, 'delete_prescription']);

    Route::get('/create_invoices', [DoctorController::class, 'create_invoices']);
    Route::post('/create_invoices', [DoctorController::class, 'post_create_invoices']);
    Route::get('/invoices_list', [DoctorController::class, 'invoices_list']);
    Route::get('/view_invoice/{id}', [DoctorController::class,'view_invoice']);
    Route::get('/delete_invoice/{id}', [DoctorController::class,'delete_invoice']);

    //IPD Patient
    Route::get('/ipd_patient',[DoctorController::class,'ipd_patient']);
    Route::post('/add_ipd_patient',[DoctorController::class,'add_ipd_patient']);
    Route::get('/edit_ipd_patient/{id}',[DoctorController::class,'edit_ipd_patient']);
    Route::post('/edit_ipd_patient/{id}',[DoctorController::class,'post_edit_ipd_patient']);
    Route::get('/delete_ipd_patient/{id}',[DoctorController::class,'delete_ipd_patient']);

    //Live Consulation
    Route::get('/live_consultation',[DoctorController::class,'live_consultation']);
    Route::get('/confirm_consultation/{id}',[DoctorController::class,'confirm_consultation']);
    Route::get('/share_room/{id}',[DoctorController::class,'share_room']);
    Route::post('/share_room/{id}',[DoctorController::class,'post_share_room']);
    Route::get('/goto_live/{id}',[DoctorController::class,'goto_live']);
    Route::get('/done_consultation/{id}',[DoctorController::class,'done_consultation']);
    
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
    Route::get('/appointments', [UserController::class, 'appointments']);
    Route::get('/resend_appointment/{id}', [UserController::class, 'resend_appointment']);
    Route::post('/post_resend_appointment', [UserController::class, 'post_resend_appointment']);
    Route::get('/generateAppointmentCard/{id}', [PdfGenerator::class, 'generateAppointmentCard']);

    Route::get('/patient_profile', [UserController::class, 'patient_profile']);
    Route::get('/add_profile_picture/{id}', [UserController::class, 'add_profile_picture']);
    Route::post('/add_profile_picture/{id}', [UserController::class, 'post_add_profile_picture']);

    Route::get('/prescription', [UserController::class, 'prescription']);
    Route::get('/view_prescription/{id}', [UserController::class, 'view_prescription']);

    // SSLCOMMERZ Start
    Route::get('/payment/{id}', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
    Route::post('/pay/{id}', [SslCommerzPaymentController::class, 'index']);
    //SSLCOMMERZ END

    Route::get('/my_invoice',[UserController::class,'my_invoice']);
    Route::get('/view_invoice/{id}',[UserController::class,'view_invoice']);

    //Live Consultation
    Route::get('/live_consultation',[UserController::class,'live_consultation']);
    Route::post('/req_live_consultation',[UserController::class,'req_live_consultation']);

    Route::get('/goto_live/{id}',[UserController::class,'goto_live']);
});

// SSLCOMMERZ Start
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//Ambulance

Route::get('/book_ambulance/',[FrontEndController::class,'book_ambulance']);
Route::post('/book_ambulance/',[FrontEndController::class,'post_book_ambulance']);

//SMS Controlling 
Route::get('/sms',[SMSController::class,'send']);