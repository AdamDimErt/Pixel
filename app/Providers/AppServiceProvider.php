<?php

namespace App\Providers;

use App\Models\Good;
use App\Models\GoodType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('goodTypes', GoodType::all());
        View::share('goodOptions', Good::all()->pluck('id', 'name'));
    }
}
