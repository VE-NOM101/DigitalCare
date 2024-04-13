<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //
    
    //index function

    public function index(){
        $data['getDepartment'] = Department::get();
        $data['getDoctor'] = Doctor::get();
        return view('index',$data);
    }
}
