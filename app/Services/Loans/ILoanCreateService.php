<?php

namespace App\Services\Loans;

use App\Models\Loan;

interface ILoanCreateService
{
    public function create(array $data): Loan;
}
