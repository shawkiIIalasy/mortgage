<?php

namespace App\Http\Controllers\Api\V0;

use App\Http\Requests\Api\V0\LoanExtraPaymentFormRequest;
use App\Http\Resources\Api\V0\LoanExtraPaymentResource;
use App\Repositories\LoanExtraRepayment\ILoanExtraRepaymentScheduleRepository;
use App\Services\LoanExtraRepayment\ILoanExtraRepaymentScheduleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LoanExtraPaymentController extends ApiController
{

    private ILoanExtraRepaymentScheduleRepository $loanExtraRepaymentScheduleRepository;
    private ILoanExtraRepaymentScheduleService $loanExtraRepaymentScheduleService;

    public function __construct(ILoanExtraRepaymentScheduleRepository $loanExtraRepaymentScheduleRepository, ILoanExtraRepaymentScheduleService $loanExtraRepaymentScheduleService)
    {
        $this->loanExtraRepaymentScheduleRepository = $loanExtraRepaymentScheduleRepository;
        $this->loanExtraRepaymentScheduleService = $loanExtraRepaymentScheduleService;
    }

    public function index(int $loanId): AnonymousResourceCollection
    {
        $loanExtraPaymentSchedules = $this->loanExtraRepaymentScheduleRepository->query()
            ->where('loan_id', $loanId)
            ->with('loan')
            ->orderBy('month_number')
            ->paginate($this->paginatePerPage);


        return LoanExtraPaymentResource::collection($loanExtraPaymentSchedules);
    }

    public function show(string $loanId, string $id): LoanExtraPaymentResource
    {
        $loanExtraPaymentSchedule = $this->loanExtraRepaymentScheduleRepository->findOrFail($id);

        $loanExtraPaymentSchedule->load('loan');

        return new LoanExtraPaymentResource($loanExtraPaymentSchedule);
    }

    public function pay(LoanExtraPaymentFormRequest $request, string $loanId, string $id): LoanExtraPaymentResource
    {
        $loanExtraPaymentSchedule = $this->loanExtraRepaymentScheduleRepository->findOrFail($id);

        $this->loanExtraRepaymentScheduleService->pay($request->amount, $loanExtraPaymentSchedule);

        $this->loanExtraRepaymentScheduleService->recalculate($loanExtraPaymentSchedule->loan);

        return new LoanExtraPaymentResource($loanExtraPaymentSchedule);
    }
}
