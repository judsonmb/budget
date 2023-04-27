<?php

namespace App\Services;

use App\Models\WebProject;

class WebProjectService 
{
    public function createWebProject(array $data, int $customerId) 
    {
        $webProject = new WebProject();
        $webProject->pages_number = $data['pages_number'];
        $webProject->has_login = $data['has_login'];
        $webProject->has_payment = $data['has_payment'];
        $webProject->customer_id = $customerId;
        $webProject->save();
        $webProject->browsers()->attach($data['browsers']);
        return $webProject;
    }
}