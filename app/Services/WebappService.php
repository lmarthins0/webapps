<?php

namespace App\Services;

use App\Actions\StoreAppVariablesOnImageSelection;
use App\Models\AppVariable;
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

    function updateApp(Webapp $webapp, array $requestData): Webapp
    {
        $requestData['dominio'] = $requestData['name'] . '.fflch.usp.br';
        $webapp->name = $requestData['name'];
        $webapp->dominio = $requestData['dominio'];
        $webapp->version = $requestData['version'];
        $webapp->image_id = $requestData['image_id'];

        $webapp->save();

        return $webapp;
    }

    function storeApp(array $requestData)
    {
        $requestData['user_id'] = auth()->user()->id;
        $requestData['dominio'] = $requestData['name'] . '.fflch.usp.br';

        $webapp = Webapp::create($requestData);

        $image = (new DockerImageService())->getImageById($requestData['image_id']);
        foreach ($image->imageVariables as $variable) {
            StoreAppVariablesOnImageSelection::execute($webapp, $variable);
        }

        return $webapp;
    }

    function storeAppVariables(AppVariable $appVariable, array $requestData)
    {
        $appVariable->value = $requestData['value'];
        $appVariable->save();

        return $appVariable;
    }
}
