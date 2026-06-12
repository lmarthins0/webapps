<?php

namespace App\Http\Controllers;

use App\Models\Webapp;
use App\Http\Requests\WebappDockerRequest;
use App\Models\EnvVariables;
use App\Services\WebappService;

class WebappDockerConfigController extends Controller
{
    public function create(Webapp $webapp)
    {
        return view('webapps.dockerconfig', [
            'webapp' => $webapp
        ]);
    }

    public function store(WebappDockerRequest $request, Webapp $webapp)
    {
        (new WebappService())->setWebappDockerConfig($webapp, $request->validated());

        return redirect("/webapps/{$webapp->id}");
    }

    public function edit(Webapp $webapp)
    {
        //dd($webapp->envVariables);
        return view('webapps.editdockerconfig', [
            'webapp' => $webapp,
        ]);
    }

    public function update(WebappDockerRequest $request, Webapp $webapp)
    {
        $webapp = (new WebappService())->updateWebappDockerConfig($webapp, $request->validated());
        return redirect("/webapps/{$webapp->id}/docker/edit");
    }
}
