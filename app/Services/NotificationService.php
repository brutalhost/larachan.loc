<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class NotificationService
{
    public function toast(string $message, string $status = 'success') {
        Session::push('toasts', ['message' => $message, 'status' => $status]);
    }
}
