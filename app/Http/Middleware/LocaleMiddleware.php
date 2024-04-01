<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class LocaleMiddleware
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle($request, Closure $next)
    {
//        if (session()->has('locale')) {
//            App::setlocale(session()->get('locale'));
//        } else {
            App::setlocale('kz');
            session()->put('locale', 'kz');
//        }

        return $next($request);
    }
}
