<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function index()
    {
        $this->middleware('auth');
        return view('auth.verify-email-gate');
    }

    public function sendVerificationMail(Request $request) {
        $this->middleware(['auth', 'throttle:10,1']);
        $request->user()->sendEmailVerificationNotification();
        return view('auth.verify-email-message');   // mail sent
    }

    public function verifyEmail(EmailVerificationRequest $request) {
        $this->middleware(['auth', 'signed']);
        $request->fulfill();
        return view('auth.verify-email-message');   // succesfully verified
    }
}
