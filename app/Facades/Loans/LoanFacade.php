<?php

namespace App\Facades\Loans;

use App\Models\Loan;
use App\Services\LoanAmortizations\ILoanAmortizationScheduleService;
use App\Services\LoanExtraRepayment\ILoanExtraRepaymentScheduleService;
use App\Services\Loans\ILoanCreateService;
use App\Services\Loans\ILoanUpdateService;
use Illuminate\Support\Facades\Facade;

class LoanFacade extends Facade implements ILoanFacade
{
    private ILoanCreateService $loanCreateService;
    private ILoanUpdateService $loanUpdateService;
    private ILoanAmortizationScheduleService $loanAmortizationScheduleService;
    private ILoanExtraRepaymentScheduleService $loanExtraRepaymentScheduleService;

    public function __construct(ILoanCreateService $loanCreateService, ILoanUpdateService $loanUpdateService, ILoanAmortizationScheduleService $loanAmortizationScheduleService, ILoanExtraRepaymentScheduleService $loanExtraRepaymentScheduleService)
    {
        $this->loanCreateService = $loanCreateService;
        $this->loanUpdateService = $loanUpdateService;
        $this->loanAmortizationScheduleService = $loanAmortizationScheduleService;
        $this->loanExtraRepaymentScheduleService = $loanExtraRepaymentScheduleService;
    }

    public function create(array $data): Loan
    {
        $loan = $this->loanCreateService->create($data);

        $this->loanAmortizationScheduleService->generate($loan);
        if ($loan->extra_payment !== null) {
            $this->loanExtraRepaymentScheduleService->generate($loan);
        }

        return $loan;
    }

    public function update(int $id, array $data): Loan
    {
        $loan = $this->loanUpdateService->update($id, $data);

        $this->loanAmortizationScheduleService->regenerate($loan);
        if ($loan->extra_payment !== null) {
            $this->loanExtraRepaymentScheduleService->regenerate($loan);
        }

        return $loan;
    }
}
