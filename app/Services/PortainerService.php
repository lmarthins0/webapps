<?php

namespace App\Services;

use App\Actions\AuthenticatePortainer;
use Illuminate\Support\Facades\Http;

class PortainerService
{
    /**
     * Create a new class instance.
     */
    protected string $jwt;
    protected string $endpointId;
    protected string $portainerUrl;

    public function __construct()
    {
        $auth = AuthenticatePortainer::execute();

        $this->jwt = $auth['jwt'];
        $this->endpointId = $auth['endpointId'];
        $this->portainerUrl = env('PORTAINER_URL');
    }

    public function createStack(string $webappName, string $yaml)
    {
        $response = Http::withToken($this->jwt)
            ->post(
                "{$this->portainerUrl}/api/stacks/create/standalone/string?endpointId={$this->endpointId}",
                [
                    'Name' => $webappName,
                    'StackFileContent' => $yaml,
                ]
            );

        return $response->json();
    }

    public function updateStack(string $webappName, string $yaml, string $stack)
    {
        $response = Http::withToken($this->jwt)
            ->put(
                "{$this->portainerUrl}/api/stacks/{$stack}?endpointId={$this->endpointId}",
                [
                    'Name' => $webappName,
                    'StackFileContent' => $yaml,
                ]
            );

        return $response->json();
    }

    public function deleteStack()
    {
        
    }
}
