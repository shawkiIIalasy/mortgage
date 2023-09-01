<?php

namespace App\Services\Loans;

use App\Models\Loan;
use App\Repositories\Loans\ILoanRepository;
use App\Services\Loans\Exceptions\LoanUpdateFailedException;

class LoanUpdateService implements ILoanUpdateService
{
    private ILoanRepository $loanRepository;

    public function __construct(ILoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * @throws LoanUpdateFailedException
     */
    public function update(int $id, array $data): Loan
    {
        $loan = $this->loanRepository->findOrFail($id);
        if (!$loan->update($data)) {
            throw new LoanUpdateFailedException("Failed to update loan id: $id");
        }
        return $loan;
    }
}
