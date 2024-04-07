<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NurseController extends Controller
{
    //
    public function dashboard()
    {
        return view('control.doctor.dashboard');
    }
    public function profile()
    {
        $user_id = Auth::user()->id;
        if (Nurse::where('user_id', $user_id)->count() > 0) {
            $details['getDetails'] = Nurse::where('user_id', $user_id)->first();
            return view('control.nurse.profile', $details);
        } else {
            return redirect('/_nurse/dashboard')->with('error', 'Your profile yet not accepted by the admin.');
        }
    }
    public function edit_profile($nurse_id, Request $request)
    {
        //Always remember where returns an array;
        $nurse = Nurse::find($nurse_id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'qualification' => 'required',
            'gender' => 'required',
        ]);

        $nurse->name = $request->input('name');
        $nurse->qualification = $request->input('qualification');
        $nurse->address = $request->input('address');
        $nurse->phone = $request->input('phone');
        $nurse->gender = $request->input('gender');
        $nurse->save();
        return redirect('/_nurse/profile')->with('success', 'Profile Updated successfully');
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
                return redirect('/_nurse/profile')->with('success', 'Password changed successfully');
            } else {
                return redirect('/_nurse/profile')->with('error', 'New passwords do not match');
            }
        } else {
            return redirect('/_nurse/profile')->with('error', 'Current password is incorrect');
        }
    }
}
