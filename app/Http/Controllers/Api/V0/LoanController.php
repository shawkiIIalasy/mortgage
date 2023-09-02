<?php

namespace App\Http\Controllers\Api\V0;

use App\Facades\Loans\ILoanFacade;
use App\Http\Requests\Api\V0\LoanFormRequest;
use App\Http\Resources\Api\V0\LoanResource;
use App\Repositories\Loans\ILoanRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LoanController extends ApiController
{
    private ILoanRepository $loanRepository;
    private ILoanFacade $loanFacade;

    public function __construct(ILoanRepository $loanRepository, ILoanFacade $loanFacade)
    {
        $this->loanRepository = $loanRepository;
        $this->loanFacade = $loanFacade;
    }

    public function index(): AnonymousResourceCollection
    {
        $loans = $this->loanRepository->query()->paginate($this->paginatePerPage);

        return LoanResource::collection($loans);
    }

    public function store(LoanFormRequest $request): LoanResource
    {
        $loan = $this->loanFacade->create($request->validated());

        return new LoanResource($loan);
    }

    public function show(string $id): LoanResource
    {
        $loan = $this->loanRepository->findOrFail($id);

        return new LoanResource($loan);
    }

    public function update(LoanFormRequest $request, string $id): LoanResource
    {
        $loan = $this->loanFacade->update($id, $request->validated());

        return new LoanResource($loan);
    }

    public function destroy(string $id)
    {
        //
    }
}
