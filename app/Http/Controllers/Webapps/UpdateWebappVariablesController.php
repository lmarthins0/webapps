<?php

namespace App\Http\Controllers\Webapps;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebappDockerImageRequest;
use App\Models\Webapp;
use App\Services\WebappService;

class UpdateWebappVariablesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Webapp $webapp, WebappDockerImageRequest $request)
    {
       (new WebappService())->updateImage($webapp, $request->validated());

        return redirect("/webapps/{$webapp->id}");
    }
}
