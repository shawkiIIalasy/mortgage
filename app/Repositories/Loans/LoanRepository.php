<?php

namespace App\Repositories\Loans;

use App\Models\Loan;
use App\Repositories\Eloquent\EloquentRepository;

class LoanRepository extends EloquentRepository implements ILoanRepository
{
    public function __construct(Loan $model)
    {
        parent::__construct($model);
    }

    public function findOrFail($id): ?Loan
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): ?Loan
    {
        return $this->model->create($data);
    }
}
