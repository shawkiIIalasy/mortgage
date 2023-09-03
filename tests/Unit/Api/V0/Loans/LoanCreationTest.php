<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoanCreationTest extends TestCase
{
    private string $url = 'api/v0/loans';
    private string $action = 'POST';

    public function testValidFields()
    {
        $this
            ->json($this->action, $this->url, [
                "amount" => 100,
                "interest_rate" => 10,
                "yearly_term" => 2
            ])
            ->assertCreated()
            ->assertJson([
                "data" => [
                    'amount' => 100,
                    'interest_rate' => 10,
                    'yearly_term' => 2,
                ]
            ]);
    }

    public function testValidFieldsWithExtraPayment()
    {
        $this
            ->json($this->action, $this->url, [
                "amount" => 100,
                "interest_rate" => 10,
                "yearly_term" => 2,
                "extra_payment" => 100
            ])
            ->assertCreated()
            ->assertJson([
                "data" => [
                    'amount' => 100,
                    'interest_rate' => 10,
                    'yearly_term' => 2,
                    'extra_payment' => 100,
                ]
            ]);
    }

    public function testInvalidAmount()
    {
        $this
            ->json($this->action, $this->url, [
                "amount" => "-100",
                "interest_rate" => "10",
                "yearly_term" => "2"
            ])
            ->assertBadRequest()
            ->assertJson([
                "status" => "Error",
                "message" => "Bad Request",
                "errors" => [
                    "amount" => []
                ]
            ]);
    }

    public function testInvalidInterestRate()
    {
        $this
            ->json($this->action, $this->url, [
                "amount" => "1000",
                "interest_rate" => "150",
                "yearly_term" => "2",
            ])
            ->assertBadRequest()
            ->assertJson([
                "status" => "Error",
                "message" => "Bad Request",
                "errors" => [
                    "interest_rate" => []
                ]
            ]);
    }

    public function testInvalidYearlyTerm()
    {
        $this
            ->json($this->action, $this->url, [
                "amount" => "1000",
                "interest_rate" => "5",
                "yearly_term" => "100",
            ])
            ->assertBadRequest()
            ->assertJson([
                "status" => "Error",
                "message" => "Bad Request",
                "errors" => [
                    "yearly_term" => []
                ]
            ]);
    }
}
