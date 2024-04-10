<?php

namespace App\Http\Controllers;

use App\Models\ApprovedAppointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\NurseAppointment;
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
}
