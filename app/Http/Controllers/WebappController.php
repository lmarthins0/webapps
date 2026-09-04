<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebappRequest;
use App\Http\Requests\AppUpdateRequest;
use App\Models\Webapp;
use App\Services\WebappService;
use App\Services\DockerImageService;
use App\Http\Requests\UpdateAppVariableRequest;
use App\Models\AppVariable;
use App\Models\DockerImage;

class WebappController extends Controller
{
    public function index()
    {
        $webapps = Webapp::all();
        return view('webapps.index', ['webapps' => $webapps]);
    }

    public function show(Webapp $webapp)
    {
        return view('webapps.show', [
            'webapp' => $webapp
        ]);
    }

    public function create(Webapp $webapp)
    {
        $dockerImages = DockerImage::all();
        return view('webapps.create', [
            'webapp' => $webapp,
            'docker_images' => $dockerImages
        ]);
    }

    public function edit(Webapp $webapp)
    {
        $dockerImages = DockerImage::all();
        return view('webapps.edit', [
            'webapp' => $webapp,
            'docker_images' => $dockerImages
        ]);
    }

    public function update(AppUpdateRequest $request, Webapp $webapp)
    {
        $webapp = (new WebappService())->updateApp($webapp, $request->validated());
        session()->flash('alert-success', 'App atualizado com sucesso.');
        return view('webapps.show', [
            'webapp' => $webapp
        ]);
    }


    public function store(WebappRequest $request)
    {

        $webapp = (new WebappService())->storeApp($request->validated());

        //session()->flash('alert-success', 'Solicitação enviada com sucesso. Aguarde a análise de um administrador');
        return view('webapps.show', [
            'webapp' => $webapp
        ]);
    }

    public function update_image(AppUpdateRequest $request, Webapp $webapp)
    {
        $webapp = (new WebappService()->updateImage($webapp, $request->validated()));

        return redirect("/webapps/{$webapp->id}");
    }

    public function show_variables(Webapp $webapp)
    {
        return view('webapps.editvariables', [
            'webapp' => $webapp,
            'env_variables' => $webapp->appVariables
        ]);
    }

    public function update_variable(Webapp $webapp, AppVariable $variable, UpdateAppVariableRequest $request)
    {
        (new WebappService())->storeAppVariables($variable, $request->validated());
        session()->flash('alert-success', 'Variável salva com sucesso.');
        return redirect("/webapps/{$variable->app_id}/variables");
    }
}
