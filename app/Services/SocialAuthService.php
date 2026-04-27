<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthService
{
    public function handleCallback($provider): User
    {
        $socialUser = Socialite::driver($provider)->user();

        $dbUser = User::updateOrCreate(
            [
                'provider_id' => $socialUser->getId(),
                'provider'    => $provider,
            ],
            [
                'name'     => $socialUser->getName(),
                'email'    => $socialUser->getEmail(),
                'password' => Hash::make('my-' . $provider),
            ]
        );

        Auth::login($dbUser);

        return $dbUser;
    }
}