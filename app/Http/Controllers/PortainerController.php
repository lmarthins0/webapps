<?php

namespace App\Http\Controllers;

use App\Services\WebappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Inline;

class PortainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $webapp = (new WebappService())->getWebappById(2);
        $yaml = [
            'services' => [
                'app' => [
                    'image' => '',
                    'restart' => 'unless-stopped',
                    'ports' => '8888:80',
                    'environment' => [
                        'APP_NAME' => 'TESTE',
                        'DB_CONNECION' => 'sqlite',
                        'APP_KEY' => 'base64:ZoysKy3Ypf5o5aObQFDLqD1H5E9gCsQL7cGWD43Mk1U=',
                        'APP_ENV' => 'local',
                        'APP_DEBUG' => 'true',
                        'APP_URL' => 'http://192.168.0.95:8888/',
                        'USP_THEME_SKIN' => 'fflch'
                    ],
                    'entrypoint' => [
                        'sh', 
                        '-c', 
                        'php artisan migrate --force && exec apache2-foreground'
                    ]
                ]
            ]
        ];
        $parsedYaml = Yaml::dump($yaml, 4, 2);
        $parsedYaml = str_replace("'-c'", "-c", $parsedYaml);
        dd($parsedYaml);
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

        $portainerUrl = env('PORTAINER_URL');
        $username = env('PORTAINER_USERNAME');
        $password = env('PORTAINER_PASSWORD');

        $auth = Http::post(
            "{$portainerUrl}/api/auth",
            [
                'username' => $username,
                'password' => $password,
            ]
        );

        $jwt = $auth->json('jwt');

        $endpoints = Http::withToken($jwt)
            ->get("{$portainerUrl}/api/endpoints")
            ->json();
        $endpointId = $endpoints[0]['Id'];


        $yaml = <<<YAML
services:
  app:
    image: {$webapp->docker_tag}:{$webapp->tag_version}
    restart: unless-stopped
    ports:
      - "8888:80"
    environment:
      APP_NAME: "TESTE"
      DB_CONNECTION: "sqlite"
      APP_KEY: "base64:ZoysKy3Ypf5o5aObQFDLqD1H5E9gCsQL7cGWD43Mk1U="
      APP_ENV: "local"
      APP_DEBUG: "true"
      APP_URL: "http://192.168.0.95:8888/"
      USP_THEME_SKIN: "fflch"
    entrypoint:
      - sh
      - -c
      - |
        php artisan migrate --force
        exec apache2-foreground
YAML;


        $response = Http::withToken($jwt)
            ->post(
                "{$portainerUrl}/api/stacks/create/standalone/string?endpointId={$endpointId}",
                [
                    'Name' => 'sites',
                    'StackFileContent' => $yaml,
                ]
            );

        dd(
            $response->status(),
            $response->json() ?: $response->body()
        );
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
