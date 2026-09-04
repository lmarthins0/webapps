<?php

namespace App\Http\Controllers;

use App\Models\AppDatabase;
use App\Services\GwmariadbService;
use Illuminate\Http\Request;
use App\Services\WebappService;
use App\Services\AppDatabaseService;
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
        if($response == false) {
            return redirect("/webapps/{$appId}");
        }
        $appDatabase = (new AppDatabaseService())->storeDatabaseData($webapp, $response['senha']);
        return redirect("/webapps/{$appId}");
    }

    /**
     * Display the specified resource.
     */
    public function show(AppDatabase $appdatabase)
    {
        return view('gwmariadb.show', [
            'database' => $appdatabase
        ]);
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
    public function update(AppDatabase $appdatabase)
    {
        $webapp = $appdatabase->App;
        $siteName = $webapp->name;

        $response = (new GwmariadbService($siteName))->trocarSenhaUsuario();

        (new AppDatabaseService())->updateDatabasePassword($appdatabase, $response['senha']);

        return redirect("/gwmariadb/{$appdatabase->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function test_connection()
    {
        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->get(env('GWMARIADB_URL'));

        return json_encode($response->json());
    }
}
