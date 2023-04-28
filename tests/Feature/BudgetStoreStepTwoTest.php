<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerStoredEmail;

class BudgetStoreStepTwoTest extends TestCase
{
    public function testBudgetStoreStepTwoSuccess(): void
    {
        Mail::fake();

        $body = ['type' => 'web'];

        $customer = \App\Models\Customer::factory()->make()->toArray();

        $project = \App\Models\WebProject::factory()->make(['browsers' => [1,2]])->toArray();

        $body = array_merge($customer, $body, $project);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/two', $body);

        $response->assertStatus(200);

        $response->assertJson(['message' => 'Saved successfully!']);

        Mail::assertSent(CustomerStoredEmail::class, function ($mail) use ($customer) {
            return $mail->hasTo($customer['email']) &&
                   $mail->hasFrom('judsonmelobandeira@gmail.com');
        });
    }
}
