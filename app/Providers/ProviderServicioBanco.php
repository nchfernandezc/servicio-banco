<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\InterfazServicioBanco;
use App\Services\ServicioBanco;

class ProviderServicioBanco extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InterfazServicioBanco::class, function ($app) {
            return new ServicioBanco();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
