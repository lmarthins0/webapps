<?php

namespace App\Services;

use App\Models\EnvVariables;
use App\Models\Webapp;

class WebappService
{
    function getWebappById(string $webappId): Webapp
    {
        $webapp = Webapp::find($webappId);
        return $webapp;
    }

    function updateImage(Webapp $webapp, array $requestData)
    {
        $webapp->image_id = $requestData['image'];
        $webapp->save();

        return $webapp;
    }

    function storeAppVariables(Webapp $webapp, array $requestData)
    {
        
    }
}
