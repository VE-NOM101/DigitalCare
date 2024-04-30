<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use sms_net_bd\SMS;

class SMSController extends Controller
{
    //
    public function send()
    {


        // Create an instance of the class
        $sms = new SMS();

        try {
            // Send Single SMS
            $response = $sms->sendSMS(
                "Hello, this is a test SMS!",
                "01910294107"
            );
            if($response){
                echo "success";
            }
        } catch (Exception $e) {
            // handle $e->getMessage();
            echo "Error:" . $e->getMessage();
        }
    }
}
