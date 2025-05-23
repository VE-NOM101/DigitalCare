<?php

namespace App\Http\Controllers;

use App\Models\ApprovedAppointment;
use App\Models\BedType;
use App\Models\DaySchedule;
use App\Models\Department;
use App\Models\DiagnosisCategory;
use App\Models\Doctor;
use App\Models\IpdPatient;
use App\Models\Medicine;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\PatientInvoice;
use App\Models\Prescription;
use App\Models\ReqLiveConsultation;
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

        if (DiagnosisCategory::where('name', $request->name)->where('id', '<>', $id)->count() == 0) {

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
        $data['getPrescription'] = Prescription::where('doctor_id', $doctor->id)->get();
        $data['getPatient'] = Patient::all();
        $data['getRA'] = RequestedAppointment::all();
        $data['getAA'] = ApprovedAppointment::all();
        return view('control.doctor.prescription', $data);
    }

    public function get_patient_appointments(Request $request)
    {
        $patientId = $request->input('patient_id');
        $patient = Patient::find($patientId);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        // Fetch appointments for the selected patient
        $appointments = RequestedAppointment::where('doctor_id', $doctor->id)->where('user_id', $patient->user_id)->where('isVisited', 1)->get();
        return response()->json($appointments);
    }

    public function add_new_prescription()
    {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $data['getPatientList'] = $doctor->patients;
        $data['getDiagnosis'] = DiagnosisCategory::all();
        $data['getMedicine'] = Medicine::all();
        return view('control.doctor.add_new_prescription', $data);
    }

    public function post_add_new_prescription(Request $request)
    {
        // Validate the form data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'req_appointment_id' => 'required|exists:requested_appointments,id',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            // Add validation rules for other fields as needed
        ]);
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        // Create a new prescription instance
        $prescription = new Prescription();
        $prescription->patient_id = $request->patient_id;
        $prescription->req_appointment_id = $request->req_appointment_id;
        $prescription->doctor_id = $doctor->id;
        $prescription->symptoms = $request->symptoms;
        $prescription->test_report = $request->test_report;
        $prescription->test_report_note = $request->test_report_note;
        // If diagnosis is multiple, ensure it's an array
        // Add other fields to the prescription instance

        // Save the prescription
        $prescription->save();

        // Handle medicine and test report information
        // Loop through medicine_id and medicine_notes to store each medicine
        foreach ($request->medicine_id as $key => $medicineId) {
            $prescription->medicines()->attach($medicineId, ['notes' => $request->medicine_notes[$key]]);
        }
        // Attach diagnoses
        $prescription->diagnoses()->attach($request->input('diagnosis'));
        // Redirect back with success message
        return redirect()->back()->with('success', 'Prescription added successfully.');
    }

    public function view_prescription($id)
    {
        $data['getPrescription'] = Prescription::find($id);
        $data['getRA'] = RequestedAppointment::find($data['getPrescription']->req_appointment_id);
        $data['getDoctor'] = Doctor::find($data['getPrescription']->doctor_id);
        $data['getPatient'] = Patient::find($data['getPrescription']->patient_id);
        $data['getDiagnosis'] = $data['getPrescription']->diagnoses()->get();
        $data['getMedicine'] = $data['getPrescription']->medicines()->get();
        return view('control.doctor.view_prescription', $data);
    }

    public function edit_prescription($id)
    {
        $data['getPrescription'] = Prescription::find($id);
        $data['getPatient'] = Patient::find(Prescription::find($id)->patient_id);
        $data['getAppointment'] = RequestedAppointment::find(Prescription::find($id)->req_appointment_id);
        $data['getSlotTime'] = ApprovedAppointment::where('request_id', Prescription::find($id)->req_appointment_id)->first();
        $data['getDiagnosis'] = DiagnosisCategory::all();
        $data['getMedicine'] = Medicine::all();
        $data['getPreviousMedicine'] = $data['getPrescription']->medicines()->withPivot('notes')->get();
        return view('control.doctor.edit_prescription', $data);
    }
    public function update_prescription($id, Request $request)
    {
        // Validate the form data
        $request->validate([
            'symptoms' => 'required',
            'diagnosis' => 'required',
            // Add validation rules for other fields as needed
        ]);

        // Find the prescription by ID
        $prescription = Prescription::findOrFail($id);

        // Update prescription details
        $prescription->symptoms = $request->symptoms;
        $prescription->test_report = $request->test_report;
        $prescription->test_report_note = $request->test_report_note;
        // Add other fields to the prescription instance

        // Save the prescription updates
        $prescription->save();

        // Detach previously attached medicines
        $prescription->medicines()->detach();

        // Detach previously attached diagnoses
        $prescription->diagnoses()->detach();

        // Attach new medicines and diagnoses
        foreach ($request->medicine_id as $key => $medicineId) {
            $prescription->medicines()->attach($medicineId, ['notes' => $request->medicine_notes[$key]]);
        }
        $prescription->diagnoses()->attach($request->input('diagnosis'));

        // Redirect back with success message
        return redirect('/_doctor/prescription')->with('success', 'Prescription updated successfully.');
    }
    public function delete_prescription($id)
    {
        // Find the prescription by ID
        $prescription = Prescription::findOrFail($id);

        // Detach associated medicines
        $prescription->medicines()->detach();

        // Detach associated diagnoses
        $prescription->diagnoses()->detach();

        // Delete the prescription
        $prescription->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Prescription deleted successfully.');
    }


    //invoices
    public function create_invoices()
    {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $data['getPatientList'] = $doctor->patients;
        $data['getDiagnosis'] = DiagnosisCategory::all();
        $data['getMedicine'] = Medicine::all();
        return view('control.doctor.create_invoices', $data);
    }
    public function post_create_invoices(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'req_appointment_id' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'title' => 'required',
            'amount' => 'required',
        ]);
        if (PatientInvoice::where('req_appointment_id', $request->req_appointment_id)->count() > 0) {
            return redirect('/_doctor/invoices_list')->with('warning', 'Invoice already exists for this appointment successfully');
        }
        $patient_invoice = new PatientInvoice();
        $patient_invoice->patient_id = $request->patient_id;
        $patient_invoice->req_appointment_id = $request->req_appointment_id;
        $patient_invoice->doctor_id = Doctor::where('user_id', Auth::user()->id)->first()->id;
        $patient_invoice->payment_method = $request->payment_method;
        $patient_invoice->status = $request->payment_status;
        $patient_invoice->title = $request->title;
        $patient_invoice->amount = $request->amount;
        $patient_invoice->save();
        return redirect('/_doctor/invoices_list')->with('success', 'Invoice added successfully');
    }

    public function invoices_list()
    {
        $doctor_id = Doctor::where('user_id', Auth::user()->id)->first()->id;
        $data['getPatientInvoices'] = PatientInvoice::where('doctor_id', $doctor_id)->get();
        $data['getPatient'] = Patient::all();
        $data['getRA'] = RequestedAppointment::all();
        return view('control.doctor.invoices_list', $data);
    }

    public function view_invoice($id)
    {
        $data['getInvoice'] = PatientInvoice::find($id);
        $data['getDoctor'] = Doctor::find($data['getInvoice']->doctor_id);
        $data['getPatient'] = Patient::find($data['getInvoice']->patient_id);
        $data['getRA'] = RequestedAppointment::find($data['getInvoice']->req_appointment_id);
        return view('control.doctor.view_invoice', $data);
    }
    public function delete_invoice($id)
    {
        $invoice = PatientInvoice::find($id);
        $invoice->delete();
        return redirect('/_doctor/invoices_list')->with('success', 'Invoice deleted successfully');
    }

    //ipd_patient

    public function ipd_patient()
    {
        $data['getPatient'] = Patient::all();
        $data['getDoctor'] = Doctor::where('user_id', Auth::user()->id)->first();
        $data['getBedType'] = BedType::all();
        $doctor_id = Doctor::where('user_id', Auth::user()->id)->first()->id;
        $data['getIpd'] = IpdPatient::where('doctor_id', $doctor_id)->get();
        $data['getInvoice'] = PatientInvoice::all();
        return view('control.doctor.ipd_patient', $data);
    }
    public function add_ipd_patient(Request $request)
    {
        $request->validate([
            'admission_date' => 'required',
        ]);
        $check = IpdPatient::where('bed_id', $request->bed_id)->count();
        if (IpdPatient::where('patient_id', $request->patient_id)->count() == 0 && $check < BedType::find($request->bed_id)->size) {
            $ipd_patient = new IpdPatient();
            $ipd_patient->patient_id = $request->patient_id;
            $ipd_patient->doctor_id = $request->doctor_id;
            $ipd_patient->bed_id = $request->bed_id;
            $ipd_patient->admission_date = $request->admission_date;
            $ipd_patient->note = $request->note;
            //
            $patient_invoice = new PatientInvoice();
            $patient_invoice->patient_id = $request->patient_id;
            $patient_invoice->doctor_id = $request->doctor_id;
            $patient_invoice->payment_method = $request->payment_method;
            $patient_invoice->status = $request->bill_status;
            $patient_invoice->title = $request->note;
            $patient_invoice->amount = BedType::find($request->bed_id)->charge;
            $patient_invoice->save();
            //
            $ipd_patient->invoice_id = $patient_invoice->id;
            $ipd_patient->save();
            return redirect('/_doctor/ipd_patient')->with('success', 'Ipd-Patient In Inserted Successfully');
        } else {
            return redirect('/_doctor/ipd_patient')->with('error', 'Patient already exists Or bed is not available');
        }
    }

    public function edit_ipd_patient($id)
    {
        $data['getPatient'] = Patient::all();
        $data['getDoctor'] = Doctor::all();
        $data['getBedType'] = BedType::all();
        $data['getIpd'] = IpdPatient::find($id);
        $data['getPayment'] = PatientInvoice::find($data['getIpd']->invoice_id)->payment_method;
        return view('control.doctor.edit_ipd_patient', $data);
    }

    public function post_edit_ipd_patient($id, Request $request)
    {
        $request->validate([
            'admission_date' => 'required',
        ]);
        $ipd_patient = IpdPatient::find($id);
        $ipd_patient->doctor_id = $request->doctor_id;
        $ipd_patient->bed_id = $request->bed_id;
        $ipd_patient->admission_date = $request->admission_date;
        $ipd_patient->note = $request->note;

        //
        $patient_invoice = PatientInvoice::find($ipd_patient->invoice_id);
        $patient_invoice->doctor_id = $request->doctor_id;
        $patient_invoice->payment_method = $request->payment_method;
        $patient_invoice->status = $request->bill_status;
        $patient_invoice->title = $request->note;
        $patient_invoice->amount = BedType::find($request->bed_id)->charge;
        $patient_invoice->save();
        //
        $ipd_patient->save();
        return redirect('/_doctor/ipd_patient')->with('success', 'Ipd-Patient In Updated Successfully');
    }

    public function delete_ipd_patient($id)
    {
        $ipd_patient = IpdPatient::find($id);
        $ipd_patient->delete();
        return redirect('/_doctor/ipd_patient')->with('success', 'Ipd-Patient In Deleted Successfully');
    }

    //Live Consultation
    public function live_consultation(){
        $data['getDoctor'] = Doctor::where('user_id',Auth::user()->id)->first();
        $data['getUser'] = User::all();
        $data['getLive'] = ReqLiveConsultation::where('doctor_id',$data['getDoctor']->id)->where('status',0)->get();
        $data['getLiveAll'] = ReqLiveConsultation::where('doctor_id',$data['getDoctor']->id)->get();
        $data['getLiveToday'] = ReqLiveConsultation::where('doctor_id',$data['getDoctor']->id)->where('date',Carbon::today())->where('status',1)->get();
        return view('control.doctor.live_consultation',$data);
    }


    public function confirm_consultation($id){
        $req_live = ReqLiveConsultation::find($id);
        $req_live->status=1;

        $req_live->save();
        return redirect('/_doctor/live_consultation')->with('success', 'Confirmed');
    }

    public function share_room($id){
        $data['getId'] = $id;
        return view('control.doctor.share_room',$data);
    }

    public function post_share_room($id, Request $request){
        $req_live = ReqLiveConsultation::find($id);
        $req_live->link = $request->link.'_'.Auth::user()->name;
        $req_live->save();
        return redirect('/_doctor/live_consultation')->with('success', 'Shared');
    }
    public function goto_live($id){
        $data['getLink'] = ReqLiveConsultation::find($id)->link;
        return view('control.doctor.goto_live',$data);
    }

    public function done_consultation($id){
        $req_live = ReqLiveConsultation::find($id);
        $req_live->status = 2;
        $req_live->save();
        return redirect('/_doctor/live_consultation')->with('success', 'Done');
    }
}
