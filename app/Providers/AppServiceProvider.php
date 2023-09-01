<?php

namespace App\Providers;

use App\Services\Loans\ILoanCreateService;
use App\Services\Loans\ILoanUpdateService;
use App\Services\Loans\LoanCreateService;
use App\Services\Loans\LoanUpdateService;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations();

        $this->app->bind(ILoanCreateService::class, LoanCreateService::class);
        $this->app->bind(ILoanUpdateService::class, LoanUpdateService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
