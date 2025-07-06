<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // GOOGLE LOGIN
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate([
            'email' => $googleUser->getEmail()
        ], [
            'name' => $googleUser->getName(),
            'password' => bcrypt('google-login'), // dummy password
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // FACEBOOK LOGIN
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();

        $user = User::firstOrCreate([
            'email' => $fbUser->getEmail()
        ], [
            'name' => $fbUser->getName(),
            'password' => bcrypt('facebook-login'), // dummy password
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}

