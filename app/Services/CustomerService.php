<?php

namespace App\Services;

use App\Models\Customer;

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
}