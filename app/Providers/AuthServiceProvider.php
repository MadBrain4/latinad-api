<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Display;
use App\Policies\DisplayPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Display::class => DisplayPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
