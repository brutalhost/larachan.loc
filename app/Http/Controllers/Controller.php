<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    public function __construct()
    {
    }

    use AuthorizesRequests, ValidatesRequests;
}
