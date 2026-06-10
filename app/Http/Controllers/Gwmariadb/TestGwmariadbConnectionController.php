<?php

namespace App\Http\Controllers\Gwmariadb;

use App\Http\Controllers\Controller;
use App\Services\WebappService;
use Illuminate\Support\Facades\Http;

class TestGwmariadbConnectionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->get(env('GWMARIADB_URL'));

        return json_encode($response->json());
    }
}
