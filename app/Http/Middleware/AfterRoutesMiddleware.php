<?php

namespace App\Http\Middleware;

use App\Services\MenuService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class AfterRoutesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Menu
        $menu = App::make(MenuService::class);
//        $menu->addElement('Home', route('home'));
        $menu->addElement('Posts', route('posts.index'));
        $menu->addElement('Users', route('users.index'));
//        $menu->addElement('Products', route('products.index'));
        view()->share('menu', $menu->getMenu());
        return $next($request);
    }
}
