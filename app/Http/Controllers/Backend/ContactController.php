<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    public function send(ContactMe $request)
{
    Mail::raw("
        Name: {$request->name}
        Email: {$request->email}
        Message: {$request->message}
    ", function ($mail) use ($request) {
        $mail->to('devmohamedalaaoraby@gmail.com')
             ->subject($request->subject);
    });

    return back()->with('success', 'Message sent successfully!');
}
}
