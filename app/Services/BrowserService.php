<?php

namespace App\Services;

use App\Models\Browser;

class BrowserService 
{
    public function getBrowsers() 
    {
        return Browser::all();
    }
}