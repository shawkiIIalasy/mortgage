<?php

namespace App\Providers;

use App\Facades\Loans\ILoanFacade;
use App\Facades\Loans\LoanFacade;
use App\Services\LoanAmortizations\ILoanAmortizationScheduleService;
use App\Services\LoanAmortizations\LoanAmortizationScheduleService;
use App\Services\LoanExtraRepayment\ILoanExtraRepaymentScheduleService;
use App\Services\LoanExtraRepayment\LoanExtraRepaymentScheduleService;
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

        $this->app->bind(ILoanFacade::class, LoanFacade::class);
        $this->app->bind(ILoanCreateService::class, LoanCreateService::class);
        $this->app->bind(ILoanUpdateService::class, LoanUpdateService::class);
        $this->app->bind(ILoanAmortizationScheduleService::class, LoanAmortizationScheduleService::class);
        $this->app->bind(ILoanExtraRepaymentScheduleService::class, LoanExtraRepaymentScheduleService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
