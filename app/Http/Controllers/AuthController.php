<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use App\Http\Requests\ResetPassword;

class AuthController extends Controller
{

    public function loadRegister()
    {
        if (Auth::user()) {
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'string|required|min:2',
            'email' => 'string|email|required|max:100|unique:users',
            'address' => 'string|required',
            'password' => 'string|required|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        return back()->with('success', 'Your Registration has been successfull.');
    }

    public function loadLogin()
    {
        if (Auth::user()) {
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('auth.login');
    }

    // public function login(Request $request)
    // {


    //     $request->validate([
    //         'email' => 'string|required|email',
    //         'password' => 'string|required'
    //     ]);

    //     $userCredential = $request->only('email', 'password');
    //     if (Auth::attempt($userCredential)) {

    //         $route = $this->redirectDash();
    //         return redirect($route);
    //     } else {
    //         return back()->with('error', 'Username & Password is incorrect');
    //     }
    // }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $userCredential = $request->only('email', 'password');
        $throttleKey = $this->throttleKey($request);

        // Check if login should be disabled before incrementing login attempts
        if (Cache::has($throttleKey) && Cache::get($throttleKey) >= 2) {
            Cache::put($throttleKey, true, now()->addMinutes(1));
            return back()->withInput()->with('error', 'Too many login attempts. Please try again in 1 minute.');
        }

        // Attempt login
        if (Auth::attempt($userCredential)) {
            // Clear the login attempts when user successfully logs in
            Cache::forget($throttleKey);

            $route = $this->redirectDash();
            return redirect($route);
        } else {
            // Increment login attempts
            $this->incrementLoginAttempts($throttleKey);

            return back()->withInput()->with('error', 'Username & Password is incorrect');
        }
    }

    protected function incrementLoginAttempts($throttleKey)
    {
        // Increment the count of login attempts
        $attempts = Cache::get($throttleKey, 0);
        $attempts++;
        Cache::put($throttleKey, $attempts, now()->addMinutes(1));
    }

    protected function throttleKey(Request $request)
    {
        return 'login_throttle_' . Str::lower($request->input('email')) . '|' . $request->ip();
    }







    //



    public function redirectDash()
    {
        $redirect = '';

        if (Auth::user() && Auth::user()->role == 1) {
            $redirect = '/_user/dashboard';
        } else if (Auth::user() && Auth::user()->role == 2) {
            $redirect = '/_doctor/dashboard';
        } else if (Auth::user() && Auth::user()->role == 3) {
            $redirect = '/_pharmacist/dashboard';
        } else if (Auth::user() && Auth::user()->role == 4) {
            $redirect = '/_admin/dashboard';
        } else {
            $redirect = '/index';
        }

        return $redirect;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/index');
    }

    public function loadForgot(Request $request)
    {
        return view('auth.forgot');
    }
    public function forgot(Request $request)
    {
        $count = User::where('email', '=', $request->email)->count();

        if ($count > 0) {
            $user = User::where('email', '=', $request->email)->first();
            $user->remember_token = Str::random(50);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Password has been reset. Please check your Spam or junk mail folder.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Not found the email in the system');
        }
    }

    public function getReset($email, $token)
    {
        if (Auth::check()) {
            return redirect('/backRoute');
        }

        $user = User::where('remember_token', '=', $token)->where('email', '=', $email);
        if ($user->count() == 0) {
            abort(404);
        }
        $user = $user->first();
        $data['token'] = $token;
        $data['email'] = $email;
        return view('auth.reset', $data);
    }
    public function postReset($email, $token, ResetPassword $request)
    {
        $user = User::where('remember_token', '=', $token)->where('email', '=', $email);
        if ($user->count() == 0) {
            abort(404);
        }
        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();
        return redirect('/backRoute')->with('success', 'Password has been reset.');
    }
}
