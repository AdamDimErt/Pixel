<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle($request, Closure $next) {
        if (session()->has('locale')) {
            App::setlocale(session()->get('locale'));
        }else{
            App::setlocale('ru');
            session()->put('locale', 'ru');
        }
        return $next($request);
    }
}
