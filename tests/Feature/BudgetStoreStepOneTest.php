<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BudgetStoreStepOneTest extends TestCase
{
    public function testBudgetStoreStepOneSuccess(): void
    {
        $customer = \App\Models\Customer::factory()->make();

        $response = $this->post('/api/budget/step/one', $customer->toArray());

        $response->assertStatus(200);

        $this->assertTrue($response->getData());
    }

    //other validation tests, like field type, the field size

    public function testBudgetStoreStepOneWithoutNameField()
    {
        $customer = \App\Models\Customer::factory()->make();
        unset($customer->name);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/one', $customer->toArray());

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The name field is required.',
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepOneWithoutEmailField()
    {
        $customer = \App\Models\Customer::factory()->make();
        unset($customer->email);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/one', $customer->toArray());

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The email field is required.',
            'errors' => [
                'email' => [
                    'The email field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepOneWithoutPhoneField()
    {
        $customer = \App\Models\Customer::factory()->make();
        unset($customer->phone);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/one', $customer->toArray());

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The phone field is required.',
            'errors' => [
                'phone' => [
                    'The phone field is required.'
                ]
            ]
        ]);
    }

    public function testBudgetStoreStepOneWithoutAddressField()
    {
        $customer = \App\Models\Customer::factory()->make();
        unset($customer->address);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/budget/step/one', $customer->toArray());

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The address field is required.',
            'errors' => [
                'address' => [
                    'The address field is required.'
                ]
            ]
        ]);
    }
}
