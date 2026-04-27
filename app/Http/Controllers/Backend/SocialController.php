<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\SocialAuthService;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function __construct(protected SocialAuthService $socialAuthService) {}

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $this->socialAuthService->handleCallback($provider);
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Failed to authenticate with ' . ucfirst($provider) . '. Please try again.');
        }
    }
}