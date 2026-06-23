<?php

namespace App\Http\Controllers\Webapps;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAppVariableRequest;
use App\Models\AppVariable;
use App\Models\Webapp;
use App\Services\WebappService;

class UpdateWebappVariablesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Webapp $webapp, AppVariable $variable, UpdateAppVariableRequest $request)
    {
        (new WebappService())->storeAppVariables($variable, $request->validated());

        return redirect("/webapps/{$variable->app_id}/variables");
    }
}
