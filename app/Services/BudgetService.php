<?php

namespace App\Services;

use App\Services\CustomerService;
use App\Services\WebProjectService;
use App\Services\MobileProjectService;
use App\Services\DesktopProjectService;
use DB;


class BudgetService 
{
    public function createBudget(array $data) 
    {
        DB::beginTransaction();

        $customer = (new CustomerService)->createCustomer($data);

        switch ($data['type']) {
            case 'web': 
                (new WebProjectService)->createWebProject($data, $customer->id);
                break;
            case 'mobile':
                (new MobileProjectService)->createMobileProject($data, $customer->id);
                break;
            case 'desktop':
                (new DesktopProjectService)->createDesktopProject($data, $customer->id);
                break;
        }

        try{
            DB::commit();

            return true;

        } catch(\Exception $e){
            DB::rollback();
            
            return null;
        }
    }
}