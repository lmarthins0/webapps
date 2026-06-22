<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebappRequest;
use App\Http\Requests\AppUpdateRequest;
use App\Models\Webapp;
use App\Services\WebappService;

class WebappController extends Controller
{
    public function index()
    {
        $webapps = Webapp::all();
        return view('webapps.index', ['webapps' => $webapps]);
    }

    public function show(Webapp $webapp)
    {
        //dd(($webapp->envVariables()->whereNotNull('value')->get()->isEmpty()));
        if ($webapp->image_id == NULL):
            $dockerStatus = 'not_configured';
        else:
            $dockerStatus = 'configured';
        endif;

        $dockerStatus;
        return view('webapps.show', [
            'webapp' => $webapp,
            'dockerStatus' => $dockerStatus
        ]);
    }

    public function create(Webapp $webapp)
    {
        return view('webapps.create', ['webapp' => $webapp]);
    }


    public function store(WebappRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $validated['dominio'] = $validated['name'] . '.fflch.usp.br';

        $webapp = Webapp::create($validated);


        session()->flash('alert-success', 'Solicitação enviada com sucesso. Aguarde a análise de um administrador');
        return redirect('/');
    }

    public function updateImage(AppUpdateRequest $request, Webapp $webapp)
    {
        $webapp = (new WebappService()->updateImage($webapp, $request->validated()));

        return redirect("/webapps/{$webapp->id}");
    }
}
