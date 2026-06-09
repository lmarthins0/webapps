<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Aws\S3\S3Client;

class ReuniaoController extends Controller
{
    public function gwmariadb()
    {
        $payload = [
            'action' => 'listar_databases',
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        dd($response->json());

    }

    public function rustfs($app)
    {
        $s3Client = new S3Client([
            'version'                 => 'latest',
            'region'                  => 'us-east-1',
            'endpoint'                => env('RUSTFS_URL'), // URL interna do Docker
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => env('RUSTFS_KEY'),
                'secret' => env('RUSTFS_SECRET'),
            ],
        ]);

        // Criar o bucket de forma simples
        $s3Client->createBucket([
            'Bucket' => $app,
        ]);

    }

    public function portainer()
    {
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


$yaml = <<<'YAML'
services:
  app:
    image: ghcr.io/fflch/sites:1.0.9
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
}
