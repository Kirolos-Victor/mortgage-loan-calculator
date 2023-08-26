<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoanApiTest extends TestCase
{
    use RefreshDatabase;

    protected mixed $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();;
    }

    public function testAmortizationCalculation()
    {
        Sanctum::actingAs($this->user);

        $data = [
                'loan_amount'          => 100000,
                'annual_interest_rate' => 5,
                'loan_term'            => 30,
        ];

        $response = $this->postJson('/api/calculate-amortization', $data);

        $response->assertStatus(200);
    }

    public function testAmortizationStorageInDatabase()
    {
        Sanctum::actingAs($this->user);

        $data = [
                'loan_amount'          => 100000,
                'annual_interest_rate' => 5,
                'loan_term'            => 30,
        ];

        $this->postJson('/api/calculate-amortization', $data);

        $this->assertDatabaseCount('loan_amortization_schedule', 360); // 30 years * 12 months
    }

    public function testExtraRepaymentCalculation()
    {
        Sanctum::actingAs($this->user);

        $data = [
                'loan_amount'          => 100000,
                'annual_interest_rate' => 5,
                'loan_term'            => 1,
                'extra_repayment'      => 10000,
        ];

        $response = $this->postJson('/api/calculate-extra-repayment-schedule', $data);

        $response->assertStatus(200);
    }

    public function testExtraRepaymentStorageInDatabase()
    {
        Sanctum::actingAs($this->user);

        $data = [
                'loan_amount'          => 100000,
                'annual_interest_rate' => 5,
                'loan_term'            => 1,
                'extra_repayment'      => 10000,
        ];

        $this->postJson('/api/calculate-extra-repayment-schedule', $data);

        $this->assertDatabaseCount('extra_repayment_schedule', 6);
    }
}
