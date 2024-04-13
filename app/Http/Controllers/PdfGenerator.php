<?php

namespace App\Http\Controllers;

use App\Models\ApprovedAppointment;
use App\Models\Doctor;
use App\Models\RequestedAppointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfGenerator extends Controller
{
    //
    public function generateAppointmentCard($id){
        
        $data['getAA']=ApprovedAppointment::where('request_id',$id)->first();
        $data['getRA']=RequestedAppointment::find($id);
        $data['getDoctor']=Doctor::find($data['getRA']->doctor_id);
        $pdf = Pdf::loadView('control.user.appointment_card', $data)->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4','potrait');
        return $pdf->stream('appointment'.now().rand('999','9999999').'.pdf');
    }
}
