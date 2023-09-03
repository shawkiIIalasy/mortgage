<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoanExtraPaymentTest extends TestCase
{
    private string $url = 'api/v0/loans/1/extra-payments/1';
    private string $action = 'POST';

    public function testValidFields()
    {
        $this
            ->json($this->action, $this->url, [
                "amount" => 100
            ])
            ->assertOk()
            ->assertJson([
                "data" => [
                    'id' => 1,
                ]
            ]);
    }

    public function testInvalidAmount()
    {
        $this
            ->json($this->action, $this->url, [
                "amount" => "-100"
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
}
