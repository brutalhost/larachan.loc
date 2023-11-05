<?php

namespace App\Http\Controllers\Auth;

use App\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Policies\AuthPolicy;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->authorize('login', User::class);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function form_post_request(LoginRequest $request)
    {
        $credentials = $request->validated();

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            Notification::toast('Login successful');
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
