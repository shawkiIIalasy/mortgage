<?php

namespace App\Services\LoanAmortizations;

use App\Models\Loan;

interface ILoanAmortizationScheduleService
{
    public function generate(Loan $loan): Loan;

    public function regenerate(Loan $loan): Loan;

}
