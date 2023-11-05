<?php

namespace App\Providers;

use App\Http\Controllers\CartController;
use App\Models\User;
use App\Services\DataTableService;
use App\Services\MenuService;
use App\Services\NotificationService;
use App\Services\PaymentGateway;
use Auth;
use Closure;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('notification-service', function () {
            return new NotificationService();
        });

        $this->app->singleton(MenuService::class, function ($app) {
            return new MenuService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $view->with('auth_user', auth()->user());
            }
        });

        Blade::if('isAdmin', function () {
            return Auth::check() && Auth::user()->isAdmin();
        });

        Blade::if('isOwner', function ($subjectUser) {
            return Auth::check() && (Auth::id() === $subjectUser->id);
        });

        Blade::if('isAdminOrOwner', function ($user) {
            return Auth::check() && (Auth::id() === $user->id || Auth::user()->isAdmin());
        });
    }
}
