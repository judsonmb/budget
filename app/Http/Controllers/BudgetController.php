<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BudgetStoreStepOneRequest;

class BudgetController extends Controller
{
    public function storeStepOne(BudgetStoreStepOneRequest $request)
    {
        return response()->json(true, 200);
    }
}
