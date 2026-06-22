<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class AuthenticatePortainer
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function execute()
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

        return [
            'jwt' => $jwt,
            'endpointId' => $endpointId
        ];
    }
}
