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
        return view('webapps.editvariables', [
            'webapp' => $webapp,
            'env_variables' => $webapp->appVariables
        ]);
    }
}
