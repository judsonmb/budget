<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCustomersTest extends TestCase
{
    /**
     * test if the api returns the pre stored customers.
     */
    public function testSuccess(): void
    {
        $customer = \App\Models\Customer::factory()->create();

        $project = \App\Models\WebProject::factory()->create(['customer_id' => $customer->id]);

        $response = $this->get('/api/customers');

        $response->assertStatus(200);

        $customers = $response->getData();

        $lastCustomer = $customers[count($customers)-1];

        $this->assertEquals($lastCustomer->name, $customer->name);
        $this->assertEquals($lastCustomer->email, $customer->email);
        $this->assertEquals($lastCustomer->phone, $customer->phone);
        $this->assertEquals($lastCustomer->address, $customer->address);

        $this->assertEquals($lastCustomer->project[0]->pages_number, $project->pages_number);
        $this->assertEquals($lastCustomer->project[0]->has_login, $project->has_login);
        $this->assertEquals($lastCustomer->project[0]->has_payment, $project->has_payment);
        $this->assertEquals($lastCustomer->project[0]->customer_id, $project->customer_id);
    }
}
