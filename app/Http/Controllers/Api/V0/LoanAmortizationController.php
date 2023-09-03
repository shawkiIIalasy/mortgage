<?php

namespace App\Http\Controllers\Api\V0;

use App\Http\Resources\Api\V0\LoanAmortizationResource;
use App\Repositories\LoanAmortizations\ILoanAmortizationScheduleRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LoanAmortizationController extends ApiController
{

    private ILoanAmortizationScheduleRepository $loanAmortizationScheduleRepository;

    public function __construct(ILoanAmortizationScheduleRepository $loanAmortizationScheduleRepository)
    {
        $this->loanAmortizationScheduleRepository = $loanAmortizationScheduleRepository;
    }

    public function index(int $loanId): AnonymousResourceCollection
    {
        $loanAmortizationSchedules = $this->loanAmortizationScheduleRepository->query()
            ->where('loan_id', $loanId)
            ->with('loan')
            ->orderBy('month_number')
            ->paginate($this->paginatePerPage);


        return LoanAmortizationResource::collection($loanAmortizationSchedules);
    }

    public function show(int $loanId, int $id): LoanAmortizationResource
    {
        $loanAmortizationSchedule = $this->loanAmortizationScheduleRepository->findOrFail($id);

        $loanAmortizationSchedule->load('loan');

        return new LoanAmortizationResource($loanAmortizationSchedule);
    }
}
