<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\WebappService;

class GwmariadbService {
    public function listarDatabase() {
        $payload = [
            'action' => 'listar_databases',
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        return $response->json();
    }

    public function criarDatabase(string $siteName) {
        if($this->userExists() && $this->databaseExists()):
        elseif($this->databaseExists()):
        endif;
        $payload = [
            'action' => 'listar_databases',
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        return $response->json();
    }

    public function trocarSenhaUsuario(string $siteName) {
        $payload = [
            'action' => 'trocar_senha',
            'nome' => $siteName
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        return $response->json();
    }

    protected function databaseExists(string $siteName) {
        $payload = [
            'action' => 'database_existe',
            "nome" => $siteName
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        dd($response->json());
    }

    protected function userExists(string $siteName) {
        $payload = [
            'action' => 'usuario_existe',
            "nome" => $siteName
        ];

        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        dd($response->json());
    }
}