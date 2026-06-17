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

    function setWebappDockerImage(Webapp $webapp, array $dockerData)
    {
        $webapp->docker_image_id = $dockerData['docker_image'];
        $webapp->save();

        return $webapp;
    }

    function setWebappEnvVariables(Webapp $webapp, array $dockerData): Webapp
    {
        $env_variables = json_decode($dockerData['env_variables']);
        foreach ($env_variables as $env_variable):
            if (EnvVariables::where('webapp_id', $webapp->id)->where('name', $env_variable->name)->exists() == false):
                EnvVariables::create([
                    'name' => $env_variable->name,
                    'value'=> $env_variable->value,
                    'webapp_id' => $webapp->id
                ]);
            elseif (EnvVariables::where('webapp_id', $webapp->id)->where('name', $env_variable->name)->exists() == true):
                $variable_to_update = EnvVariables::where('webapp_id', $webapp->id)->where('name', $env_variable->name)->first();
                $variable_to_update->update([
                    'value' => $env_variable->value
                ]);
            endif;
        endforeach;

        return $webapp;
    }
}
