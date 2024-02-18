<?php

namespace App\Facades\Loans;

use App\Models\Loan;

interface ILoanFacade
{
    public function create(array $data): Loan;

    public function update(int $id, array $data): Loan;
}
