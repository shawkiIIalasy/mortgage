<?php

namespace App\Services\LoanExtraRepayment;

use App\Models\Loan;
use App\Models\LoanExtraRepaymentSchedule;
use App\Repositories\LoanExtraRepayment\ILoanExtraRepaymentScheduleRepository;

class LoanExtraRepaymentScheduleService implements ILoanExtraRepaymentScheduleService
{
    private ILoanExtraRepaymentScheduleRepository $loanExtraRepaymentScheduleRepository;

    public function __construct(ILoanExtraRepaymentScheduleRepository $loanExtraRepaymentScheduleRepository)
    {
        $this->loanExtraRepaymentScheduleRepository = $loanExtraRepaymentScheduleRepository;
    }

    public function generate(Loan $loan): Loan
    {
        $months = $loan->getTermInMonths();

        $endBalance = 0;
        for ($month = 1; $month <= $months; $month++) {
            $lastPayment = false;
            $monthlyPayment = $loan->getMonthlyPayment();
            $extraPayment = $loan->extra_payment;
            $startBalance = $month == 1 ? $loan->amount : $endBalance;
            $monthlyInterestAmount = $startBalance * $loan->getMonthlyInterestRate();
            $monthlyPrincipalAmount = $monthlyPayment - $monthlyInterestAmount;
            $endBalance = $startBalance - $monthlyPrincipalAmount;

            if ($extraPayment !== null) {
                $endBalance -= $extraPayment;
            }

            if ($endBalance < 0) {
                $extraPayment = 0;
                $endBalance = 0;
                $monthlyPayment = $startBalance;
                $monthlyPrincipalAmount = $monthlyPayment - $monthlyInterestAmount;
                $lastPayment = true;
            }

            $this->loanExtraRepaymentScheduleRepository->create([
                'loan_id' => $loan->id,
                'month_number' => $month,
                'start_balance' => $startBalance,
                'amount' => $monthlyPayment,
                'extra_amount' => $extraPayment,
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
        $loan->extraRepaymentSchedules()->delete();

        $this->generate($loan);

        return $loan;
    }

    public function pay(float $amount, LoanExtraRepaymentSchedule $loanExtraRepaymentSchedule): Loan
    {
        $loanExtraRepaymentSchedule->update([
            'extra_amount' => $loanExtraRepaymentSchedule->extra_amount + $amount,
        ]);

        return $loanExtraRepaymentSchedule->loan;
    }

    public function recalculate(Loan $loan): Loan
    {
        $endBalance = 0;
        foreach ($loan->extraRepaymentSchedules as $extraRepaymentSchedule) {
            $lastPayment = false;
            $monthlyPayment = $extraRepaymentSchedule->amount;
            $extraPayment = $extraRepaymentSchedule->extra_amount;
            $startBalance = $extraRepaymentSchedule->month_number == 1 ? $loan->amount : $endBalance;
            $monthlyInterestAmount = $startBalance * $loan->getMonthlyInterestRate();
            $monthlyPrincipalAmount = $monthlyPayment - $monthlyInterestAmount;
            $endBalance = $startBalance - $monthlyPrincipalAmount;

            if ($extraPayment !== null) {
                $endBalance -= $extraPayment;
            }

            if ($endBalance < 0) {
                $extraPayment = 0;
                $endBalance = 0;
                $monthlyPayment = $startBalance;
                $monthlyPrincipalAmount = $monthlyPayment - $monthlyInterestAmount;
                $lastPayment = true;
            }

            $extraRepaymentSchedule->update([
                'start_balance' => $startBalance,
                'amount' => $monthlyPayment,
                'extra_amount' => $extraPayment,
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
}
