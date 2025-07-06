<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $otp = rand(100000, 999999);
        Session::put('mfa_otp', $otp);
        Session::put('mfa_user_id', $user->id);
        Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your OTP Code');
        });
        
        Auth::logout();

        return redirect()->back()->with('otp_required', true)->with('status', 'OTP sent to your email!');
    }

    return back()->with('error', 'Invalid credentials!');
}


    public function verifyOtp(Request $request)
{
    if ($request->input('otp') == session('mfa_otp')) {
        Auth::loginUsingId(session('mfa_user_id'));

        session()->forget(['mfa_user_id', 'mfa_otp']);

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['otp' => 'Invalid OTP.']);
}

}

