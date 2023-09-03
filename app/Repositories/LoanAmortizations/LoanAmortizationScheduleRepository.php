<?php

namespace App\Repositories\LoanAmortizations;

use App\Models\LoanAmortizationSchedule;
use App\Repositories\Eloquent\EloquentRepository;

class LoanAmortizationScheduleRepository extends EloquentRepository implements ILoanAmortizationScheduleRepository
{
    public function __construct(LoanAmortizationSchedule $model)
    {
        parent::__construct($model);
    }

    public function findOrFail($id): ?LoanAmortizationSchedule
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): ?LoanAmortizationSchedule
    {
        return $this->model->create($data);
    }
}
