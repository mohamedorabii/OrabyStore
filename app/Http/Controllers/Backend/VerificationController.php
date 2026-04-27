<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReturnTypeWillChange;

class VerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');

    }
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', true);
    }
}
