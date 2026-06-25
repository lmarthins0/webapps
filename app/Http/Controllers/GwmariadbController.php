<?php

namespace App\Http\Controllers;

use App\Services\GwmariadbService;
use Illuminate\Http\Request;
use App\Services\WebappService;
use Illuminate\Support\Facades\Http;

class GwmariadbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = (new GwmariadbService())->listarDatabase();

        dd($response);
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
    public function store(string $appId)
    {
        $webapp = (new WebappService())->getWebappById($appId);
        $siteName = $webapp->name;

        $response = (new GwmariadbService($siteName))->storeDatabase();

        return var_dump($response->json());
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
    public function edit(string $appId) {
        
        return view('gwmariadb.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $appId)
    {
        $webapp = (new WebappService())->getWebappById($appId);
        $siteName = $webapp->name;

        $response = (new GwmariadbService($siteName))->trocarSenhaUsuario();

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
