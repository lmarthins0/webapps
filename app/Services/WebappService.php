<?php

namespace App\Services;

use App\Models\Webapp;

class WebappService 
{
    function getWebappById(string $webappId): Webapp
    {
        $webapp = Webapp::find($webappId);
        return $webapp;
    }
}