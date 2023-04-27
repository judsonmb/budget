<?php

namespace App\Services;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;

class CustomerService 
{
    public function createCustomer(array $data) 
    {
        $customer = new Customer();
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->phone = $data['phone'];
        $customer->address = $data['address'];
        $customer->save();
        return $customer;
    }

    public function getCustomers()
    {
        return CustomerResource::collection(
                    Customer::with('webProjects')
                                ->with('mobileProjects')
                                ->with('desktopProjects')
                                ->get()
                    );
    }
}