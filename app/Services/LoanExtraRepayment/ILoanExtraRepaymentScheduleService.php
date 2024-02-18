<?php

namespace App\Services\LoanExtraRepayment;

use App\Models\Loan;
use App\Models\LoanExtraRepaymentSchedule;

interface ILoanExtraRepaymentScheduleService
{
    public function generate(Loan $loan): Loan;

    public function regenerate(Loan $loan): Loan;

    public function recalculate(Loan $loan): Loan;

    public function pay(float $amount, LoanExtraRepaymentSchedule $loanExtraRepaymentSchedule): Loan;
}
