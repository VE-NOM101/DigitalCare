<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //
    
    //index function

    public function index(){
        $departments['getDepartment'] = Department::get();
        return view('index',$departments);
    }
}
