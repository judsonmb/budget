<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    public function getCustomers(Request $request)
    {
        $customers = (new CustomerService)->getCustomers();
        return response()->json($customers, 200);
    }
}
