<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BrowserService;

class BrowserController extends Controller
{
    public function getBrowsers(Request $request) 
    {
        $browsers = (new BrowserService)->getBrowsers();
        return response()->json($browsers, 200);
    }
}
