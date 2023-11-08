<?php

namespace App\Http\Controllers\Auth;

use App\Facades\NotificationFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authorize('register', User::class);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function form_post_request(RegisterRequest $request)
    {
        $credentials = $request->validated();

        $user = User::create($credentials);

        Auth::login($user);

        $request->session()->regenerate();

        NotificationFacade::toast('Register successful');
        return redirect()->intended('/');
    }
}

