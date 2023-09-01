<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'yearly_term',
        'interest_rate',
        'extra_payment'
    ];

    public function amortizationSchedules(): HasMany {
        return $this->hasMany(LoanAmortizationSchedule::class);
    }

    public function extraRepaymentSchedules(): HasMany {
        return $this->hasMany(LoanExtraRepaymentSchedule::class);
    }
}
