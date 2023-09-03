<?php

namespace App\Repositories\LoanExtraRepayment;

use App\Models\LoanExtraRepaymentSchedule;
use App\Repositories\Eloquent\EloquentRepository;

class LoanExtraRepaymentScheduleRepository extends EloquentRepository implements ILoanExtraRepaymentScheduleRepository
{
    public function __construct(LoanExtraRepaymentSchedule $model)
    {
        parent::__construct($model);
    }

    public function findOrFail($id): ?LoanExtraRepaymentSchedule
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): ?LoanExtraRepaymentSchedule
    {
        return $this->model->create($data);
    }
}
