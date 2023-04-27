<?php

namespace App\Services;

use App\Models\MobileProject;

class MobileProjectService 
{
    public function createMobileProject(array $data, int $customerId) 
    {
        $mobileProject = new MobileProject();
        $mobileProject->platform = $data['platform'];
        $mobileProject->screens_number = $data['screens_number'];
        $mobileProject->has_login = $data['has_login'];
        $mobileProject->has_payment = $data['has_payment'];
        $mobileProject->customer_id = $customerId;
        $mobileProject->save();
        return $mobileProject;
    }
}