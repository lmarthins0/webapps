<?php

namespace App\Http\Controllers\Webapps;

use App\Http\Controllers\Controller;
use App\Models\Webapp;
use App\Services\DockerImageService;

class ShowWebappVariablesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Webapp $webapp)
    {
        $env_variables = (new DockerImageService())->getImageVariables($webapp->image_id);
        return view('webapps.envvariables', [
            'webapp' => $webapp,
            'env_variables' => $env_variables
        ]);
    }
}
