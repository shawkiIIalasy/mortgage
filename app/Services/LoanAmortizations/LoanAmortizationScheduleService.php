<?php

namespace App\Services\LoanAmortizations;

use App\Models\Loan;
use App\Repositories\LoanAmortizations\ILoanAmortizationScheduleRepository;

class LoanAmortizationScheduleService implements ILoanAmortizationScheduleService
{
    private ILoanAmortizationScheduleRepository $loanAmortizationScheduleRepository;

    public function __construct(ILoanAmortizationScheduleRepository $loanAmortizationScheduleRepository)
    {
        $this->loanAmortizationScheduleRepository = $loanAmortizationScheduleRepository;
    }

    public function generate(Loan $loan): Loan
    {
        $months = $loan->getTermInMonths();

        $endBalance = 0;
        for ($month = 1; $month <= $months; $month++) {
            $lastPayment = false;
            $monthlyPayment = $loan->getMonthlyPayment();
            $startBalance = $month == 1 ? $loan->amount : $endBalance;
            $monthlyInterestAmount = $startBalance * $loan->getMonthlyInterestRate();
            $monthlyPrincipalAmount = $monthlyPayment - $monthlyInterestAmount;
            $endBalance = $startBalance - $monthlyPrincipalAmount;

            if ($endBalance < 0) {
                $endBalance = 0;
                $monthlyPayment = $startBalance;
                $monthlyPrincipalAmount = $monthlyPayment - $monthlyInterestAmount;
                $lastPayment = true;
            }

            $this->loanAmortizationScheduleRepository->create([
                'loan_id' => $loan->id,
                'month_number' => $month,
                'start_balance' => $startBalance,
                'amount' => $monthlyPayment,
                'principal_amount' => $monthlyPrincipalAmount,
                'interest_amount' => $monthlyInterestAmount,
                'end_balance' => $endBalance,
            ]);

            if ($lastPayment) {
                break;
            }
        }

        return $loan;
    }

    public function regenerate(Loan $loan): Loan
    {
        $loan->amortizationSchedules()->delete();

        $this->generate($loan);

        return $loan;
    }
}
