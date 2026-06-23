<?php

namespace App\Services;

use App\Actions\StoreAppVariablesOnImageSelection;
use App\Models\AppVariable;
use App\Models\EnvVariables;
use App\Models\ImageVariable;
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
        $image = (new DockerImageService())->getImageById($requestData['image']);
        foreach ($image->imageVariables as $variable) {
            StoreAppVariablesOnImageSelection::execute($webapp, $variable);
        }
        
        $webapp->image_id = $requestData['image'];
        $webapp->save();

        return $webapp;
    }

    function storeAppVariables(AppVariable $appVariable, array $requestData)
    {
        $appVariable->value = $requestData['value'];
        $appVariable->save();

        return $appVariable;
    }
}
