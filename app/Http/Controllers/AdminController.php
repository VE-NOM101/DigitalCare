<?php

namespace App\Http\Controllers;

use App\Models\ApprovedAppointment;
use App\Models\Block;
use App\Models\DaySchedule;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\NurseAppointment;
use App\Models\RequestedAppointment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //Users
    public function dashboard()
    {
        return view('control.admin.dashboard');
    }
    public function users()
    {
        $data['getRecord']  = User::get();
        return view('control.admin.users', $data);
    }
    public function edit_users($id)
    {
        $data['getRecord'] = User::find($id);
        return view('control.admin.edit_users', $data);
    }
    public function update_users($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->save();

        return redirect('/_admin/users')->with('success', 'User is successfully updated');
    }
    public function delete_users($id)
    {
        $data = User::find($id);
        $data->delete();
        //using error tag for indicating deletion
        return redirect('/_admin/users')->with('error', 'User record deleted successfully');
    }

    //Roles

    public function roles()
    {
        $data['getRecord']  = User::paginate(5);
        return view('control.admin.roles', $data);
    }

    public function edit_roles($id, Request $request)
    {
        $user = User::find($id);
        $user->role = $request->role;
        $user->save();
        return redirect('/_admin/roles')->with('success', 'User role updated successfully');
    }

    //blocks

    public function blocks()
    {
        $data['getRecord']  = Block::get();
        return view('control.admin.blocks', $data);
    }
    public function add_blocks(Request $request)
    {
        $blocks = new Block;
        $blocks->blockName = $request->input('blockName');
        $blocks->blockCode = $request->input('blockCode');
        $blocks->save();
        return redirect('/_admin/add_blocks')->with('success', 'Block inserted successfully');
    }

    public function edit_blocks($id)
    {
        $blocks['getRecord'] = Block::find($id);

        return view('control.admin.edit_blocks', $blocks);
    }
    public function update_blocks($id, Request $request)
    {
        $blocks = Block::find($id);
        $blocks->blockName =  $request->blockName;
        $blocks->blockCode = $request->blockCode;
        $blocks->save();
        return redirect('/_admin/blocks')->with('success', 'Block updated successfully');
    }
    public function delete_blocks($id)
    {
        $blocks = Block::find($id);
        $blocks->delete();
        return redirect('/_admin/blocks')->with('error', 'Block deleted successfully');
    }

    //departments
    public function departments()
    {
        $departments['getRecord'] = Department::get();
        return view('control.admin.departments', $departments);
    }
    public function show_departments()
    {
        $blocks['getBlock'] = Block::get();
        return view('control.admin.add_departments', $blocks);
    }

    public function add_departments(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo_path' => 'required|mimes:png,jpg,jpeg,bmp',
            'description' => 'required',
        ]);

        $imageName = '';
        if ($image = $request->file('photo_path')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //into public folder
            $image->move('digitalcare/admin/departments', $imageName);
        }

        $department = new Department;
        $department->name = $request->input('name');
        $department->photo_path = $imageName;
        $department->description = $request->input('description');
        $department->block_id = $request->input('block_id');
        $department->save();
        return redirect('/_admin/show_departments')->with('success', 'Department added successfully');
    }

    public function edit_departments($id)
    {
        $departments['getRecord'] = Department::find($id);
        $departments['getBlock'] = Block::get();
        return view('control.admin.edit_departments', $departments);
    }

    public function update_departments($id, Request $request)
    {

        $department = Department::find($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $imageName = '';
        $deleteOldImage = 'digitalcare/admin/departments/' . $department->photo_path;

        if ($image = $request->file('photo_path')) {
            if (file_exists($deleteOldImage)) {
                File::delete($deleteOldImage);
            }
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //into public folder
            $image->move('digitalcare/admin/departments', $imageName);
        } else {
            $imageName = $department->photo_path;
        }

        $department->name = $request->input('name');
        $department->photo_path = $imageName;
        $department->description = $request->input('description');
        $department->block_id = $request->input('block_id');
        $department->save();
        return redirect('/_admin/departments')->with('success', 'Department Updated successfully');
    }

    public function delete_departments($id)
    {
        $department = Department::find($id);
        $deleteOldImage = 'digitalcare/admin/departments/' . $department->photo_path;
        if (file_exists($deleteOldImage)) {
            File::delete($deleteOldImage);
        }
        $department->delete();

        return redirect('/_admin/departments')->with('error', 'Department Deleted successfully');
    }
    //doctors

    public function doctors()
    {
        $doctors['getDoctor'] = User::where('role', 2)->get();
        $doctors['getRecord'] = Doctor::get();
        $doctors['getDepartment'] = Department::get();
        return view('control.admin.doctors', $doctors);
    }
    public function add_doctors(Request $request)
    {
        $doctor = new Doctor;
        $user = User::find($request->input('user_id'));
        $check = $doctor->where('email', '=', $user->email)->first();
        if ($check) {

            return redirect('/_admin/doctors')->with('error', 'Doctor already exists');
        }
        $doctor->user_id = $request->input('user_id');
        $doctor->name = $user->name;
        $doctor->email = $user->email;
        $doctor->department_id = $request->input('department_id');
        $doctor->save();

        //newly added for schedule
        $schedule = new DaySchedule;
        $schedule->doctor_id = $doctor->id;
        $schedule->save();
        return redirect('/_admin/doctors')->with('success', 'Doctor added successfully');
    }
    public function delete_doctors($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        //schedule code
        $schedule = DaySchedule::where('doctor_id', $id)->delete();
        return redirect('/_admin/doctors')->with('success', 'Doctor deleted successfully');
    }

    //nurses
    public function nurses()
    {
        $nurses['getNurse'] = User::where('role', 5)->get();
        $nurses['getRecord'] = Nurse::get();
        return view('control.admin.nurses', $nurses);
    }
    public function add_nurses(Request $request)
    {
        $nurse = new Nurse;
        $user = User::find($request->input('user_id'));
        $check = $nurse->where('email', '=', $user->email)->first();
        if ($check) {

            return redirect('/_admin/nurses')->with('error', 'Nurse already exists');
        }

        $nurse->user_id = $request->input('user_id');
        $nurse->name = $user->name;
        $nurse->email = $user->email;
        $nurse->address = $user->address;
        $nurse->save();
        return redirect('/_admin/nurses')->with('success', 'Nurse added successfully');
    }
    public function delete_nurses($id)
    {
        $nurse = Nurse::find($id);
        $nurse->delete();
        return redirect('/_admin/nurses')->with('success', 'Doctor deleted successfully');
    }

    //appointments

    public function appointments()
    {
        $data['getApproved'] = ApprovedAppointment::all();
        $data['getRequest'] = RequestedAppointment::all();
        $data['getDoctor'] = Doctor::all();
        $data['getNurse'] = Nurse::all();
        $data['getAppointedNurse'] = NurseAppointment::all();
        return view('control.admin.appointments', $data);
    }
    public function cancel_appointment($id)
    {
        $approved_appointment = ApprovedAppointment::find($id);
        $requested_appointment = RequestedAppointment::find($approved_appointment->request_id);
        $approved_appointment->delete();
        $requested_appointment->isConfirmed = 2;
        $requested_appointment->save();
        return redirect('/_admin/appointments')->with('warning', 'Appointment Canceled Successfully.');
    }
    public function confirm_appointment($id)
    {
        $approved_appointment = ApprovedAppointment::find($id);
        $requested_appointment = RequestedAppointment::find($approved_appointment->request_id);
        $appointed_nurse = NurseAppointment::where('appointed_date', $requested_appointment->preferred_date)->get();
        $allNurse = Nurse::all();
        $available_nurse_id = collect();
        foreach ($allNurse as $nurse) {
            $check = $appointed_nurse->where('nurse_id', $nurse->id)->count();
            if ($check < 10) {
                $available_nurse_id->push($nurse->id);
            }
        }
        $data['getNurse'] = $allNurse;
        $data['getAllNurseId'] = $available_nurse_id;
        $data['getApprovedId'] = $id;
        $data['getAppointedDate'] = $requested_appointment->preferred_date;

        return view('control.admin.confirm_appointments', $data);
    }
    public function post_confirm_appointment($approved_id, Request $request)
    {
        if ($request->nurse_id) {
            $approved_appointment = ApprovedAppointment::find($approved_id);
            $requested_appointment = RequestedAppointment::find($approved_appointment->request_id);
            $newNurseAppointment = new NurseAppointment;
            $newNurseAppointment->nurse_id = $request->nurse_id;
            $newNurseAppointment->appointed_date = $requested_appointment->preferred_date;
            $newNurseAppointment->save();
            $approved_appointment->nurse_appointment_id = $newNurseAppointment->id;
            $approved_appointment->save();
            $requested_appointment->isConfirmed = 1;
            $requested_appointment->save();
            return redirect('/_admin/appointments')->with('success', 'Appointment Confirmed Successfully.');
        }else{
            return redirect('/_admin/appointments')->with('error', 'No nurse selected.');
        }
    }
}
