<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class SendGwmariadbRequest
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function execute(array $payload)
    {
        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->post(env('GWMARIADB_URL'), $payload);

        return $response->json();
    }
}
