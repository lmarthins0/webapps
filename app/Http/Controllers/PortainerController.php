<?php

namespace App\Http\Controllers;

use App\Actions\GenerateComposeYml;
use App\Services\PortainerService;
use App\Services\WebappService;

class PortainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $webapp = (new WebappService())->getWebappById(1);
        $dockerImage = $webapp->dockerImage;

        $composeYml = GenerateComposeYml::execute($dockerImage, $webapp);
        dd($composeYml);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $webappId)
    {
        $webapp = (new WebappService())->getWebappById($webappId);
        $dockerImage = $webapp->dockerImage;
        $composeYml = GenerateComposeYml::execute($dockerImage, $webapp);
        dd($composeYml);
        $response = (new PortainerService())->createStack($webapp->name, $composeYml);

        $webapp->status = "Publicado";
        $webapp->stack = $response['Id'];
        $webapp->save();

        return redirect("/webapps/{$webapp->id}");

        //dd($response->status(), $response->json() ?: $response->body());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $webappId)
    {
        $webapp = (new WebappService())->getWebappById($webappId);
        $dockerImage = $webapp->dockerImage;
        $stackId = $webapp->stack;

        $composeYml = GenerateComposeYml::execute($dockerImage, $webapp);

        $response = (new PortainerService())->updateStack($webapp->name, $composeYml, $stackId);

        return redirect("/webapps/{$webapp->id}");

        dd(
            $response->status(),
            $response->json() ?: $response->body()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
