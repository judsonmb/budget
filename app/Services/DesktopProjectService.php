<?php

namespace App\Services;

use App\Models\DesktopProject;

class DesktopProjectService 
{
    public function createDesktopProject(array $data, int $customerId) 
    {
        $desktopProject = new DesktopProject();
        $desktopProject->supported_os = $data['supported_os'];
        $desktopProject->screens_number = $data['screens_number'];
        $desktopProject->supports_prints = $data['supports_prints'];
        $desktopProject->access_license = $data['access_license'];
        $desktopProject->customer_id = $customerId;
        $desktopProject->save();
        return $desktopProject;
    }
}