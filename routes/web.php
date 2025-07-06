<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FollowUpController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\SocialLoginController;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('welcome');
});


Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verify.otp');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');

// Example: protected dashboard route
Route::get('/dashboard', function () {
    return view('dashboard'); // Create this view if needed
})->middleware('auth')->name('dashboard');




Route::middleware('auth')->prefix('customers')->name('customers.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
});


Route::middleware('auth')->group(function () {
    Route::resource('followups', FollowUpController::class);
    Route::get('/followups/{followup}', [FollowUpController::class, 'show'])->name('followups.show');

});



Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');





// Redirect to Google
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

// Handle callback
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    // Example: login or register the user
    $user = \App\Models\User::firstOrCreate([
        'email' => $googleUser->getEmail(),
    ], [
        'name' => $googleUser->getName(),
        'password' => bcrypt('secret'), // Dummy password
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});


Route::get('/auth/facebook', [SocialLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);




