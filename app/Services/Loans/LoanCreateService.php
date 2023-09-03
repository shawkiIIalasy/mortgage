<?php

namespace App\Services\Loans;

use App\Models\Loan;
use App\Repositories\Loans\ILoanRepository;

class LoanCreateService implements ILoanCreateService
{
    private ILoanRepository $loanRepository;

    public function __construct(ILoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    public function create(array $data): Loan
    {
        return $this->loanRepository->create($data);
    }
}
