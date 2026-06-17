<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebappDockerImageRequest;
use App\Models\Webapp;
use App\Http\Requests\WebappDockerRequest;
use App\Models\EnvVariables;
use App\Services\DockerImageService;
use App\Services\WebappService;
use Illuminate\database\Eloquent\Collection;

class WebappDockerConfigController extends Controller
{
    public function create(Webapp $webapp)
    {
        $dockerImages = (new DockerImageService())->getAllDockerImages();
        return view('webapps.dockerimage', [
            'webapp' => $webapp,
            'docker_images' => $dockerImages
        ]);
    }

    public function store(WebappDockerImageRequest $request, Webapp $webapp)
    {
        (new WebappService())->setWebappDockerImage($webapp, $request->validated());

        return redirect("/webapps/{$webapp->id}");
    }

    public function edit(Webapp $webapp)
    {
        $image_env_variables = (new DockerImageService())->getImageEnvVariables($webapp->docker_image_id);
        $webapp_env_variables = EnvVariables::where('webapp_id', $webapp->id)->get();
        $env_variables = $this->mergeActiveEnvVariablesWebappAndDockerImage($webapp_env_variables, $image_env_variables);
        //dd($image_env_variables, $webapp_env_variables, $env_variables);
        return view('webapps.envvariables', [
            'webapp' => $webapp,
            'env_variables' => $env_variables
        ]);
    }

    public function update(WebappDockerRequest $request, Webapp $webapp)
    {
        $webapp = (new WebappService())->setWebappEnvVariables($webapp, $request->validated());
        return redirect("/webapps/{$webapp->id}");
    }

    protected function mergeActiveEnvVariablesWebappAndDockerImage(mixed $webapp_env_variables, array $image_env_variables)
    {
        $env_variables = [];
        if($webapp_env_variables) {
            foreach ($webapp_env_variables as $webapp_variable) {
                if (in_array($webapp_variable->name, $image_env_variables, true)) {
                    $env_variable['name'] = $webapp_variable->name;
                    $env_variable['value'] = $webapp_variable->value;
                    $env_variables[] = $env_variable;
                    $image_env_variables = array_diff($image_env_variables, [$image_env_variables[array_search($webapp_variable->name, $image_env_variables, true)]]);
                }
            }
        }

        foreach ($image_env_variables as $image_variable) {
            $env_variable['name'] = $image_variable;
            $env_variable['value'] = null;
            $env_variables[] = $env_variable;
        }

        return $env_variables;
    }
}
