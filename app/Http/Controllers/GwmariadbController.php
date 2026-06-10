<?php

namespace App\Http\Controllers;

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
        $payload = [
            'action' => 'listar_databases',
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        dd($response->json());
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
        $siteName = explode('.', $webapp->dominio)[0];

        $payload = [
            'action' => 'criar_database_usuario_privilegio',
            'nome' => $siteName
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
