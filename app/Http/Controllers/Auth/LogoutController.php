<?php

namespace App\Http\Controllers\Auth;

use App\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $this->authorize('logout', User::class);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Notification::toast('Logout successful');
        return redirect()->route('home');
    }
}
