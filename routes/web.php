<?php

use App\Http\Controllers\DockerImageController;
use App\Http\Controllers\GwmariadbController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortainerController;
use App\Http\Controllers\BucketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::prefix('webapps')->group(function() {
    Route::get('/', [WebappController::class, 'index']);
    Route::get('/create', [WebappController::class, 'create']);
    Route::post('/store', [WebappController::class, 'store']);
    Route::get('/{webapp}', [WebappController::class, 'show']);
    Route::get('/{webapp}/variables', [WebappController::class, 'show_variables']);
    Route::get('/{webapp}/database/store', [GwmariadbController::class, 'store']);
    Route::get('/{webapp}/bucket/store', [BucketController::class, 'store']);
    Route::get('/{webapp}/edit', [WebappController::class, 'edit']);
    Route::put('/{webapp}/', [WebappController::class, 'update']);
    Route::put('/{webapp}/variables/{variable}', [WebappController::class, 'update_variable']);
});

Route::prefix('dockerimages')->group(function() {
    Route::get('/', [DockerImageController::class, 'index']);
    Route::get('/create', [DockerImageController::class, 'create']);
    Route::get('/{dockerimage}', [DockerImageController::class, 'show']);
    Route::get('/{dockerimage}/edit', [DockerImageController::class, 'edit']);
    Route::post('/', [DockerImageController::class, 'store']);
    Route::post('/{dockerimage}/variable/store', [DockerImageController::class, 'store_variable']);
    Route::put('/{dockerimage}', [DockerImageController::class, 'update']);
    Route::put('/{dockerimage}/variable/{imagevariable}', [DockerImageController::class, 'update_variable']);
    Route::delete('/{dockerimage}', [DockerImageController::class, 'destroy']);
    Route::delete('/{dockerimage}/variable/{imagevariable}', [DockerImageController::class, 'destroy_variable']);
});

Route::prefix('gwmariadb')->group(function () {
    Route::get('/', [GwmariadbController::class, 'index']);
    Route::get('/testconnection', [GwmariadbController::class, 'test_connection']);
    Route::get('/{appdatabase}', [GwmariadbController::class, 'show']);
    Route::put('/{appdatabase}/update', [GwmariadbController::class, 'update']);
    Route::delete('/{appdatabase}', [GwmariadbController::class, 'destroy']);
});

Route::prefix('bucket')->group(function() {
    Route::get('/test', [BucketController::class, 'test_connection']);
    Route::get('/{bucket}', [BucketController::class, 'show']);
    Route::delete('/{bucket}', [BucketController::class, 'destroy']);
});

Route::prefix('portainer')->group(function() {
    Route::get('/', [PortainerController::class, 'index']);
    Route::get('/{webapp}/store', [PortainerController::class, 'store']);
    Route::get('/{webapp}/update', [PortainerController::class, 'update']);
});