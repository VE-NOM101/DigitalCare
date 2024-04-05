<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ResetPassword extends FormRequest{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'password' => 'string|required|min:6',
            'confirm_password' => 'string|required|min:6|same:password',
        ];
    }
        
}