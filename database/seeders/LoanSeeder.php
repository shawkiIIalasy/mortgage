<?php

namespace Database\Seeders;

use App\Facades\Loans\ILoanFacade;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    private const ITEM_LENGTH = 10;
    private const ITEM_LENGTH_WITH_FIXED_EXTRA_PAYMENT = 10;

    private ILoanFacade $loanFacade;

    public function __construct(ILoanFacade $loanFacade)
    {
        $this->loanFacade = $loanFacade;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($counter = 0; $counter < self::ITEM_LENGTH; $counter++) {
            $amount = rand(1, 10000);
            $this->loanFacade->create([
                'amount' => $amount,
                'interest_rate' => rand(1, 100),
                'yearly_term' => rand(1, 35),
            ]);
        }

        for ($counter = 0; $counter < self::ITEM_LENGTH_WITH_FIXED_EXTRA_PAYMENT; $counter++) {
            $amount = rand(1, 10000);
            $this->loanFacade->create([
                'amount' => $amount,
                'interest_rate' => rand(1, 100),
                'yearly_term' => rand(1, 35),
                'extra_payment' => rand(1, $amount),
            ]);
        }
    }
}
