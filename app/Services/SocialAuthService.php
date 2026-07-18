<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthService
{
    public function handleCallback($provider): User
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            $user->update([
                'name'        => $socialUser->getName(),
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        } else {
            $user = User::create([
                'name'        => $socialUser->getName(),
                'email'       => $socialUser->getEmail(),
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
                'password'    => Hash::make(Str::random(32)),
            ]);
        }

        Auth::login($user);

        return $user;
    }
}