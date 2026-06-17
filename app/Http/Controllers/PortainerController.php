<?php

namespace App\Http\Controllers;

use App\Services\DockerImageService;
use App\Services\WebappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Yaml\Yaml;

class PortainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $webapp = (new WebappService())->getWebappById(1);
        $dockerImage = $webapp->dockerImage;
        $env_variables = $webapp->envVariables;

        $environment = [];
        foreach ($env_variables as $env_variable):
            $environment[$env_variable->name] = $env_variable->value;
        endforeach;

        $yaml = [
            'services' => [
                'app' => [
                    'image' => "{$dockerImage->path}:{$dockerImage->tag}",
                    'restart' => 'unless-stopped',
                    'ports' => '8888:80',
                    'environment' => $environment,
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
        $dockerImage = $webapp->dockerImage;
        $webappName = explode('.', $webapp->dominio)[0];

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


        $env_variables = $webapp->envVariables;
        $environment = [];
        foreach ($env_variables as $env_variable):
            $environment[$env_variable->name] = $env_variable->value;
        endforeach;

        $yaml = [
            'services' => [
                'app' => [
                    'image' => "{$dockerImage->path}:{$dockerImage->tag}",
                    'restart' => 'unless-stopped',
                    'ports' => ['8888:80'],
                    'environment' => $environment,
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

        $response = Http::withToken($jwt)
            ->post(
                "{$portainerUrl}/api/stacks/create/standalone/string?endpointId={$endpointId}",
                [
                    'Name' => $webappName,
                    'StackFileContent' => $parsedYaml,
                ]
            );

        $responseDecoded = $response->json();
        $webapp->status = "Publicado";
        $webapp->stackId = $responseDecoded['Id'];
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
        $stackId = $webapp->stackId;
        $webappName = explode('.', $webapp->dominio)[0];

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


        $env_variables = $webapp->envVariables;
        $environment = [];
        foreach ($env_variables as $env_variable):
            $environment[$env_variable->name] = $env_variable->value;
        endforeach;

        $yaml = [
            'services' => [
                'app' => [
                    'image' => "{$dockerImage->path}:{$dockerImage->tag}",
                    'restart' => 'unless-stopped',
                    'ports' => ['8888:80'],
                    'environment' => $environment,
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

        $response = Http::withToken($jwt)
            ->put(
                "{$portainerUrl}/api/stacks/{$stackId}?endpointId={$endpointId}",
                [
                    'Name' => $webappName,
                    'StackFileContent' => $parsedYaml,
                ]
            );

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
