<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveEmptyParams
{
    protected $except = [
        'tracy/bar',
        // Добавьте другие URL-адреса, которые не должны вызывать повторное выполнение middleware
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $query = $request->query();

        foreach($query as $param => $value) {
            if(empty($value)) {
                unset($query[$param]);
            }
        }

        $newUrl = $request->url() . ( $query ? '?' . http_build_query($query) : '');

        if ($request->fullUrl() === $newUrl) {
            return $next($request);
        }

        // Добавьте проверку, чтобы middleware не выполнялось повторно
        if ($request->is($this->except)) {
            return $next($request);
        }

        return redirect($newUrl);
    }

}
