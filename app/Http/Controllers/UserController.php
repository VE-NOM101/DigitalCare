<?php

namespace App\Http\Controllers;

use App\Models\ApprovedAppointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\NurseAppointment;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\RequestedAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Exists;
use App\Rules\FutureDateTime;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    //

    public function dashboard()
    {
        return view('control.user.dashboard');
    }
    public function request_appointment(Request $request)
    {
        $currentTime = Carbon::now()->format('H:i');
        $appointment = new RequestedAppointment;

        // Validate individual fields
        $request->validate([
            'phone' => 'required',
            'preferred_date' => 'required',
            'description' => 'required',
        ]);

        // Combine date and time into preferred_datetime
        $preferredDateTime = $request->preferred_date . ' ' . $currentTime;

        // Validate the combined datetime
        $validator = Validator::make([
            'preferred_datetime' => $preferredDateTime
        ], [
            'preferred_datetime' => ['required', new FutureDateTime],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        $appointment->name = Auth::user()->name;
        $appointment->email = Auth::user()->email;
        $appointment->phone = $request->input('phone');
        $appointment->user_id = Auth::user()->id;
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->preferred_date = $request->input('preferred_date');
        $appointment->description = $request->description;
        $appointment->save();

        return redirect('/index')->with('success', 'Appointment requested successfully');
    }


    public function appointments(){
        $data['getRA'] = RequestedAppointment::where('user_id',Auth::user()->id)->get();
        $data['getDoctor'] = Doctor::all();
        $data['getAA'] = ApprovedAppointment::all();
        $data['getNA'] = NurseAppointment::all();
        $data['getNurse'] = Nurse::all();
      
        return view('control.user.appointments',$data);
    }
    public function resend_appointment($id){
        $data['getRA'] = RequestedAppointment::find($id);
        $data['getDoctor'] = Doctor::all();
        return view('control.user.resend_appointment',$data);
    }

    public function post_resend_appointment(Request $request)
    {
        $currentTime = Carbon::now()->format('H:i');
        $appointment = new RequestedAppointment;

        // Validate individual fields
        $request->validate([
            'phone' => 'required',
            'preferred_date' => 'required',
            'description' => 'required',
        ]);

        // Combine date and time into preferred_datetime
        $preferredDateTime = $request->preferred_date . ' ' . $currentTime;

        // Validate the combined datetime
        $validator = Validator::make([
            'preferred_datetime' => $preferredDateTime
        ], [
            'preferred_datetime' => ['required', new FutureDateTime],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        $appointment->name = $request->input('name');
        $appointment->email = $request->input('email');
        $appointment->phone = $request->input('phone');
        $appointment->user_id = Auth::user()->id;
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->preferred_date = $request->input('preferred_date');
        $appointment->description = $request->description;
        $appointment->save();

        return redirect('/_user/appointments')->with('success', 'Appointment resend successfully');
    }

    public function patient_profile(){
    //     $doctor_id = Doctor::where('user_id', Auth::user()->id)->first()->id;
        $data['getPatient'] = Patient::where('user_id',Auth::user()->id)->first();
        $data['getAppointment'] = RequestedAppointment::where('user_id', Auth::user()->id)->get();
        $data['getDoctor'] = Doctor::all();
        $data['getApproved'] = ApprovedAppointment::all();
        return view('control.user.patient_profile',$data);
    }
    public function add_profile_picture($id){
        $data['id'] =$id;
        $data['getPatient'] = Patient::find($id);
        return view('control.user.add_profile_picture',$data);
    }

    public function post_add_profile_picture($id, Request $request){
        $patient = Patient::find($id);
        $request->validate([
            'photo_path' => 'required|mimes:png,jpg,jpeg,bmp',
        ]);

        $imageName = '';
        $deleteOldImage = 'digitalcare/patients/profile/' . $patient->photo_path;

        if ($image = $request->file('photo_path')) {
            if (file_exists($deleteOldImage)) {
                File::delete($deleteOldImage);
            }
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //into public folder
            $image->move('digitalcare/patients/profile', $imageName);
        } else {
            $imageName = $patient->photo_path;
        }
        $patient->photo_path = $imageName;
        $patient->save();
        return redirect('/_user/patient_profile')->with('success', 'Picture Uploaded successfully');
    }

    public function prescription()
    {
        $patient = Patient::where('user_id',Auth::user()->id)->first();

        $data['getPrescription'] = Prescription::where('patient_id', $patient->id)->get();
        $data['getPatient'] = Patient::all();
        $data['getRA'] = RequestedAppointment::all();
        $data['getAA'] = ApprovedAppointment::all();
        $data['getDoctor'] = Doctor::all();
        return view('control.user.prescription', $data);
    }

    public function view_prescription($id)
    {
        $data['getPrescription'] = Prescription::find($id);
        $data['getRA'] = RequestedAppointment::find($data['getPrescription']->req_appointment_id);
        $data['getDoctor'] = Doctor::find($data['getPrescription']->doctor_id);
        $data['getPatient'] = Patient::find($data['getPrescription']->patient_id);
        $data['getDiagnosis'] = $data['getPrescription']->diagnoses()->get();
        $data['getMedicine'] = $data['getPrescription']->medicines()->get();
        return view('control.user.view_prescription', $data);
    }
}
