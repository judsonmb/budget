<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BudgetStoreStepOneRequest;
use App\Http\Requests\BudgetStoreStepTwoRequest;
use App\Services\BudgetService;

class BudgetController extends Controller
{
    public function storeStepOne(BudgetStoreStepOneRequest $request)
    {
        return response()->json(true, 200);
    }

    public function storeStepTwo(BudgetStoreStepTwoRequest $request)
    {
        (new BudgetService)->createBudget($request->all());
        return response()->json(['message' => 'Saved successfully!'], 200);
    }
}
