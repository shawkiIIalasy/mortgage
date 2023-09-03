<?php

namespace App\Http\Resources\Api\V0;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'yearly_effective_interest_rate' => $this->getEffectiveInterestRate()
        ]);
    }
}
