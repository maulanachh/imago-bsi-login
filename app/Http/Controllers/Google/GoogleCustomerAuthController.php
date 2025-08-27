<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\UserCustomer;
use App\Models\master\customers;

class GoogleCustomerAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $googleUser =  Socialite::driver('google')->stateless()->user();

        $user = UserCustomer::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'google_id' => $googleUser->getId(),
                'password' => null, // jika tidak ada password manual
            ]
        );

        // Buat data customer jika belum ada
        // if (!$user->customer) {
        //     customers::create([
        //         'user_customer_id' => $user->id,
        //         'name' => $googleUser->getName(),
        //         'phone' => '',
        //         'address' => '',
        //     ]);
        // }

        Auth::guard('customer')->login($user);

        return redirect('/home');
    }
}
