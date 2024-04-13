<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    //

    public function dashboard()
    {
        return view('control.pharmacist.dashboard');
    }
    public function medicines(){
        return view('control.pharmacist.medicines');
    }
}
