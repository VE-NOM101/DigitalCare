<?php

namespace App\Http\Controllers;

use App\Models\ApprovedAppointment;
use App\Models\DaySchedule;
use App\Models\Department;
use App\Models\DiagnosisCategory;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
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
use Illuminate\Support\Str;

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



    //schedule

    public function schedule()
    {
        $user_id = Auth::user()->id;
        $doctor_id = Doctor::where('user_id', $user_id)->first();
        if ($doctor_id) {
            $doctor_id = $doctor_id->id;
            $schedule['getSchedule'] = DaySchedule::where('doctor_id', $doctor_id)->first();
            return view('control.doctor.schedule', $schedule);
        } else {
            return redirect('/_doctor/dashboard')->with('error', 'Doctor yet not registered by admin');
        }
    }

    public function update_schedule($id, Request $request)
    {

        $request->validate([
            'per_patient_time' => 'required|string|max:2'
        ]);
        $schedule = DaySchedule::find($id);
        $schedule->monday1 = $request->monday1;
        $schedule->monday2 = $request->monday2;
        $schedule->tuesday1 = $request->tuesday1;
        $schedule->tuesday2 = $request->tuesday2;
        $schedule->wednesday1 = $request->wednesday1;
        $schedule->wednesday2 = $request->wednesday2;
        $schedule->thursday1 = $request->thursday1;
        $schedule->thursday2 = $request->thursday2;
        $schedule->friday1 = $request->friday1;
        $schedule->friday2 = $request->friday2;
        $schedule->saturday1 = $request->saturday1;
        $schedule->saturday2 = $request->saturday2;
        $schedule->sunday1 = $request->sunday1;
        $schedule->sunday2 = $request->sunday2;

        $schedule->per_patient_time = $request->per_patient_time;
        $schedule->save();

        return redirect('/_doctor/schedule')->with('success', 'Schedule Updated Successfully');
    }

    public function fetchAvailableSlots($doctor_id, $preferred_date)
    {
        $preferred_date = Carbon::parse($preferred_date);
        $all_approves = ApprovedAppointment::all();
        $times = collect(); // Initialize as a collection

        // Retrieve all approved appointments for the specified doctor and preferred date
        $all_requests = RequestedAppointment::where('doctor_id', $doctor_id)
            ->where('preferred_date', $preferred_date)
            ->where('isApproved', 1)
            ->get();

        // Extract intime from approved appointments and store in $times collection
        foreach ($all_requests as $request) {
            $slotTime = $all_approves->where('request_id', $request->id)->first()->slotTime;
            $times->push($slotTime);
        }

        // Now you have all booked slots in $times collection
        // You can calculate further available slots based on doctor's schedule

        // Get the doctor's schedule for that specific day
        $schedule = DaySchedule::where('doctor_id', $doctor_id)->first();

        // Assuming each appointment duration is in minutes
        $appointmentDuration = $schedule->per_patient_time;

        // Initialize available slots array
        $availableSlots = collect();

        // Get the start and end times for the doctor's availability on that day
        $startTimeColumn = strtolower($preferred_date->englishDayOfWeek) . '1';
        $endTimeColumn = strtolower($preferred_date->englishDayOfWeek) . '2';

        $startTime = Carbon::parse($schedule->$startTimeColumn);
        $endTime = Carbon::parse($schedule->$endTimeColumn);

        // Start from the beginning of the day until the end time
        $currentTime = $startTime->copy();

        // Loop through the doctor's available time slots
        while ($currentTime->lte($endTime)) {
            // Check if the current time slot is not in $times (booked slots)

            if (!$times->contains($currentTime->toTimeString())) {
                $availableSlots->push($currentTime->copy()->toTimeString());
            }

            // Move to the next time slot
            $currentTime->addMinutes($appointmentDuration);
        }

        // Return the available slots
        return $availableSlots;
    }

    //appointments

    public function appointments()
    {
        if (Doctor::where('user_id', Auth::user()->id)->count() > 0) {
            $doctor_id = Doctor::where('user_id', Auth::user()->id)->first()->id;
            $allRequests = RequestedAppointment::where('isApproved', 0)->where('isConfirmed', 0)->where('doctor_id', $doctor_id)->get();
            $allAvailableSlots = [];
            foreach ($allRequests as $request) {
                $slots = $this->fetchAvailableSlots($doctor_id, $request->preferred_date);
                $allAvailableSlots[$request->id] = $slots;
            }
            $approved = RequestedAppointment::where('isApproved', 1)->where('doctor_id', $doctor_id)->get();
            $approvedSlots = ApprovedAppointment::all();
            $data['getRA'] = $allRequests;
            $data['getAvailableSlots'] = $allAvailableSlots;
            $data['getApproved'] = $approved;
            $data['getApprovedSlots'] = $approvedSlots;
            $data['getTodayList'] = RequestedAppointment::where('isApproved', 1)
                ->where('isConfirmed', 1)
                ->where('doctor_id', $doctor_id)
                ->whereDate('preferred_date', Carbon::today()->format('Y-m-d'))
                ->get();
            return view('control.doctor.appointments', $data);
        }
        return redirect('/_doctor/dashboard')->with('error', 'Doctor yet not registered by admin');
    }

    public function visited($id)
    {
        $requested_appointment = RequestedAppointment::find($id);
        $requested_appointment->isVisited = 1;
        $requested_appointment->save();
        return redirect('/_doctor/appointments')->with('success', 'Marked as Visited!');
    }

    public function approve_appointment($id, Request $request)
    {
        $requested_appointment = RequestedAppointment::find($id);

        $request->validate([
            'slotTime' => 'required',
        ]);

        $approved_appointment = new ApprovedAppointment;
        $approved_appointment->slotTime = $request->slotTime;
        $approved_appointment->request_id = $id;
        $requested_appointment->isApproved = 1;
        $approved_appointment->save();
        $requested_appointment->save();
        return redirect('/_doctor/appointments')->with('success', 'Request Approved Successfully');
    }

    public function cancel_appointment($id)
    {
        $requested_appointment = RequestedAppointment::find($id);
        $requested_appointment->isConfirmed = 2;
        $requested_appointment->save();

        return redirect('/_doctor/appointments')->with('warning', 'Appointment Canceled Successfully.');
    }
    //Patient
    public function search_users(Request $request)
    {
        $email = trim($request->query('email')); // Trim input email

        // Search for users by email (case-insensitive)
        $users = User::whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($email) . '%'])->get();

        // Return search results as JSON
        return response()->json($users);
    }

    public function add_new_patient()
    {
        return view('control.doctor.add_new_patient');
    }
    public function post_add_new_patient(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'address' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'height' => 'required',
            'blood_group' => 'required',
            'pulse' => 'required',
            'blood_pressure' => 'required',
            'allergy' => 'required',
            'weight' => 'required',
            'respiration' => 'required',
            'diet' => 'required',
        ]);
        $existingPatient = Patient::where('user_id', $request->id)->first();
        $doctor_id = Doctor::where('user_id', Auth::user()->id)->first()->id;
        if ($existingPatient) {
            // Patient already exists
            // Check if the patient is already associated with the doctor

            if ($existingPatient->doctors->contains($doctor_id)) {
                return redirect('/_doctor/add_new_patient')->with('warning', 'Patient already exists and is already attached to this doctor.');
            } else {
                // Attach the patient to the doctor
                $existingPatient->doctors()->attach($doctor_id);
                return redirect('/_doctor/add_new_patient')->with('warning', 'Patient already exists. Attached with doctor');
            }
        } else {
            $patient = new Patient;
            $patient->name = $request->name;
            $patient->email = $request->email;
            $patient->gender = $request->gender;
            $patient->address = $request->address;
            $patient->age = $request->age;
            $patient->phone = $request->phone;
            $patient->height = $request->height;
            $patient->blood_group = $request->blood_group;
            $patient->pulse = $request->pulse;
            $patient->blood_pressure = $request->blood_pressure;
            $patient->allergy = $request->allergy;
            $patient->weight = $request->weight;
            $patient->respiration = $request->respiration;
            $patient->diet = $request->diet;
            $patient->user_id = $request->id;
            $patient->save();
            $patient->doctors()->attach($doctor_id);
            return redirect('/_doctor/add_new_patient')->with('success', 'New patient added succesfully');
        }
    }

    public function patient_list()
    {
        $patient = Patient::all();
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $data['getMyPatientList'] = $doctor->patients;
        $data['getAllPatientList'] = $patient;
        return view('control.doctor.patient_list', $data);
    }

    public function view_patient($id)
    {
        $doctor_id = Doctor::where('user_id', Auth::user()->id)->first()->id;
        $data['getPatient'] = Patient::find($id);
        $data['getAppointment'] = RequestedAppointment::where('user_id', $data['getPatient']->user_id)->where('doctor_id', $doctor_id)->get();
        $data['getDoctor'] = Doctor::all();
        $data['getApproved'] = ApprovedAppointment::all();
        return view('control.doctor.view_patient', $data);
    }
    public function attach_patient($id)
    {
        $patient = Patient::find($id);
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        if ($patient->doctors->contains($doctor->id)) {
            return redirect('/_doctor/patient_list')->with('warning', 'Patient already attached');
        } else {

            $patient->doctors()->attach($doctor->id);
            return redirect('/_doctor/patient_list')->with('success', 'Patient attached succesfully');
        }
    }

    public function edit_patient($id)
    {
        $data['getPatient'] = Patient::find($id);
        return view('control.doctor.edit_patient', $data);
    }
    public function update_patient($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'height' => 'required',
            'blood_group' => 'required',
            'pulse' => 'required',
            'blood_pressure' => 'required',
            'allergy' => 'required',
            'weight' => 'required',
            'respiration' => 'required',
            'diet' => 'required',
        ]);
        $patient = Patient::find($id);
        $patient->name = $request->name;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->age = $request->age;
        $patient->phone = $request->phone;
        $patient->height = $request->height;
        $patient->blood_group = $request->blood_group;
        $patient->pulse = $request->pulse;
        $patient->blood_pressure = $request->blood_pressure;
        $patient->allergy = $request->allergy;
        $patient->weight = $request->weight;
        $patient->respiration = $request->respiration;
        $patient->diet = $request->diet;
        $patient->save();
        return redirect('/_doctor/view_patient/' . $id)->with('success', 'Patient Updated succesfully');
    }

    public function detach_patient($id)
    {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $patient = Patient::find($id);
        $patient->doctors()->detach($doctor->id);
        return redirect('/_doctor/patient_list')->with('success', 'Patient Detached succesfully');
    }

    public function diagnosis()
    {
        $data['getDiagnosis'] = DiagnosisCategory::all();
        return view('control.doctor.diagnosis', $data);
    }
    public function add_diagnosis()
    {
        return view('control.doctor.add_diagnosis');
    }
    public function post_add_diagnosis(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        if (DiagnosisCategory::where('name', $request->name)->count() == 0) {

            $diagnosis_category = new DiagnosisCategory;
            $diagnosis_category->name = $request->name;
            $diagnosis_category->description = $request->description;
            $diagnosis_category->save();

            return redirect(url('_doctor/diagnosis'))->with('success', 'Diagnosis category added successfully');
        } else {
            return redirect(url('_doctor/diagnosis'))->with('error', 'Diagnosis category already exists');
        }
    }

    public function edit_diagnosis($id)
    {
        $data['getDiagnosis'] = DiagnosisCategory::find($id);
        return view('control.doctor.edit_diagnosis', $data);
    }
    public function update_diagnosis($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if (DiagnosisCategory::where('name', $request->name)->count() == 1) {

            $diagnosis_category = DiagnosisCategory::find($id);
            $diagnosis_category->name = $request->name;
            $diagnosis_category->description = $request->description;
            $diagnosis_category->save();

            return redirect(url('_doctor/diagnosis'))->with('success', 'Diagnosis category updated successfully');
        } else {
            return redirect(url('_doctor/diagnosis'))->with('error', 'Diagnosis category already exists');
        }
    }
    public function delete_diagnosis($id)
    {
        $diagnosis = DiagnosisCategory::find($id);
        $diagnosis->delete();
        return redirect(url('_doctor/diagnosis'))->with('success', 'Diagnosis category deleted successfully');
    }

    public function prescription()
    {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $data['getPatientList'] = $doctor->patients;
        $data['getDiagnosis'] = DiagnosisCategory::all();
        return view('control.doctor.prescription', $data);
    }

    public function get_patient_appointments(Request $request)
    {
        $patientId = $request->input('patient_id');
        $patient = Patient::find($patientId);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
        $doctor = Doctor::where('user_id',Auth::user()->id)->first();
        // Fetch appointments for the selected patient
        $appointments = RequestedAppointment::where('doctor_id',$doctor->id)->where('user_id',$patient->user_id)->where('isVisited',1)->get();
        return response()->json($appointments);
    }
}
