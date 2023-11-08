<?php

namespace App\Facades;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Facade;

class NotificationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NotificationService::class;
    }
}
