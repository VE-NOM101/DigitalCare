<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
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

class DoctorController extends Controller
{
    //

    public function dashboard()
    {
        return view('control.doctor.dashboard');
    }
    public function profile()
    {


        $user_id = Auth::user()->id;
        if (Doctor::where('user_id', $user_id)->count() > 0) {
            $details['getDetails'] = Doctor::where('user_id', $user_id)->first();
            $details['getDepartment'] = Department::find($details['getDetails']->first()->department_id)->name;
            return view('control.doctor.profile', $details);
        } else {
            return redirect('/_doctor/dashboard')->with('error', 'Your profile yet not accepted by the admin.');
        }
    }
    public function edit_profile($doctor_id, $user_id, Request $request)
    {
        //Always remember where returns an array;
        $doctor = Doctor::find($doctor_id);
        $user = User::find($user_id);

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'specialist' => 'required',
            'qualification' => 'required',
            //newly gender guard added
            'gender' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'checkout_time1' => 'required',
            'checkout_time2' => 'required',
        ]);

        $imageName = '';
        $deleteOldImage = 'digitalcare/doctors/profile/' . $doctor->photo_path;

        if ($image = $request->file('photo_path')) {
            if (file_exists($deleteOldImage)) {
                File::delete($deleteOldImage);
            }
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //into public folder
            $image->move('digitalcare/doctors/profile', $imageName);
        } else {
            $imageName = $doctor->photo_path;
        }

        $doctor->name = $request->input('name');
        $doctor->photo_path = $imageName;
        $doctor->qualification = $request->input('qualification');
        $doctor->address = $request->input('address');
        $doctor->specialist = $request->input('specialist');
        $doctor->phone = $request->input('phone');
        $doctor->facebook = $request->input('facebook');
        $doctor->linkedin = $request->input('linkedin');
        $doctor->gender = $request->input('gender');
        $doctor->checkout_time1 = $request->input('checkout_time1');
        $doctor->checkout_time2 = $request->input('checkout_time2');
        $doctor->save();
        return redirect('/_doctor/profile')->with('success', 'Profile Updated successfully');
    }
    public function change_password($id, Request $request)
    {
        $user = User::find($id);
        $request->validate([
            'password' => 'string|required|min:6',
            'newpassword' => 'string|required|min:6|different:password',
            'renewpassword' => 'string|required|min:6|same:newpassword',
        ]);

        if (Hash::check($request->password, $user->password)) {
            if ($request->newpassword === $request->renewpassword) {
                $user->password = Hash::make($request->newpassword); // Hash the new password
                $user->save();
                return redirect('/_doctor/profile')->with('success', 'Password changed successfully');
            } else {
                return redirect('/_doctor/profile')->with('error', 'New passwords do not match');
            }
        } else {
            return redirect('/_doctor/profile')->with('error', 'Current password is incorrect');
        }
    }

    

    public function appointments(){
        $data['getRA'] = RequestedAppointment::where('isApproved',0)->get();
        return view('control.doctor.appointments',$data);
    }

    public function approve_appointment($id){
        $req_appointment = RequestedAppointment ::find($id);

    }
}
