<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanExtraRepaymentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'month_number',
        'start_balance',
        'amount',
        'principal_amount',
        'interest_amount',
        'extra_amount',
        'end_balance',
    ];

    public function loan(): BelongsTo {
        return $this->belongsTo(Loan::class);
    }
}
