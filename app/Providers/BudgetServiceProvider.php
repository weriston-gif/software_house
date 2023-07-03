<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BudgetService;

class BudgetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('budgetService', function () {
            return new BudgetService();
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
