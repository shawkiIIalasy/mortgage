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

    public function amortizationSchedules(): HasMany
    {
        return $this->hasMany(LoanAmortizationSchedule::class);
    }

    public function extraRepaymentSchedules(): HasMany
    {
        return $this->hasMany(LoanExtraRepaymentSchedule::class);
    }

    public function getTermInMonths(): float|int
    {
        return $this->yearly_term * 12;
    }

    public function getMonthlyInterestRate(): float|int
    {
        return ($this->interest_rate / 12) / 100;
    }

    public function getMonthlyPayment(): float|int
    {
        return ($this->amount * $this->getMonthlyInterestRate()) / (1 - pow(1 + $this->getMonthlyInterestRate(), -1 * $this->getTermInMonths()));
    }

    public function getEffectiveInterestRate(): float|int
    {
        return (pow(1 + $this->interest_rate / 100 / $this->getTermInMonths(), $this->getTermInMonths()) - 1) * 100;
    }
}
