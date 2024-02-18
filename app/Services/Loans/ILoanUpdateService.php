<?php

namespace App\Services\Loans;

use App\Models\Loan;

interface ILoanUpdateService
{
    public function update(int $id, array $data): Loan;
}
