<?php

namespace App\Http\Controllers\Api\V0;

use App\Http\Requests\Api\V0\LoanFormRequest;
use App\Http\Resources\Api\V0\LoanResource;
use App\Repositories\Loans\ILoanRepository;
use App\Services\Loans\ILoanCreateService;
use App\Services\Loans\ILoanUpdateService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LoanController extends ApiController
{
    private ILoanRepository $loanRepository;
    private ILoanCreateService $loanCreateService;
    private ILoanUpdateService $loanUpdateService;

    public function __construct(ILoanRepository $loanRepository, ILoanCreateService $loanCreateService, ILoanUpdateService $loanUpdateService)
    {
        $this->loanRepository = $loanRepository;
        $this->loanCreateService = $loanCreateService;
        $this->loanUpdateService = $loanUpdateService;
    }

    public function index(): AnonymousResourceCollection
    {
        $loans = $this->loanRepository->query()->paginate($this->paginatePerPage);

        return LoanResource::collection($loans);
    }

    public function store(LoanFormRequest $request): LoanResource
    {
        $loan = $this->loanCreateService->create($request->validated());

        return new LoanResource($loan);
    }

    public function show(string $id): LoanResource
    {
        $loan = $this->loanRepository->findOrFail($id);

        return new LoanResource($loan);
    }

    public function update(LoanFormRequest $request, string $id): LoanResource
    {
        $loan = $this->loanUpdateService->update($id, $request->validated());

        return new LoanResource($loan);
    }

    public function destroy(string $id)
    {
        //
    }
}
