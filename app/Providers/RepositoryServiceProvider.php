<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\Eloquent\IEloquentRepository;
use App\Repositories\LoanAmortizations\ILoanAmortizationScheduleRepository;
use App\Repositories\LoanAmortizations\LoanAmortizationScheduleRepository;
use App\Repositories\LoanExtraRepayment\ILoanExtraRepaymentScheduleRepository;
use App\Repositories\LoanExtraRepayment\LoanExtraRepaymentScheduleRepository;
use App\Repositories\Loans\ILoanRepository;
use App\Repositories\Loans\LoanRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IEloquentRepository::class, EloquentRepository::class);
        $this->app->bind(ILoanRepository::class, LoanRepository::class);
        $this->app->bind(ILoanAmortizationScheduleRepository::class, LoanAmortizationScheduleRepository::class);
        $this->app->bind(ILoanExtraRepaymentScheduleRepository::class, LoanExtraRepaymentScheduleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
