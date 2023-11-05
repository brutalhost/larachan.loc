<?php

namespace App\Facades;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Facade;

class Notification extends Facade
{
    protected static function getFacadeAccessor() {
        return NotificationService::class;
    }
}
