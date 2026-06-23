<?php

use App\Http\Controllers\Bucket\CreateBucketController;
use App\Http\Controllers\Bucket\DeleteBucketController;
use App\Http\Controllers\Bucket\TestConnectionBucketController;
use App\Http\Controllers\Dockerimage\ImageVariableController;
use App\Http\Controllers\DockerImageController;
use App\Http\Controllers\Webapps\ShowWebappVariablesController;
use App\Http\Controllers\Gwmariadb\TestGwmariadbConnectionController;
use App\Http\Controllers\GwmariadbController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortainerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebappDockerConfigController;
use App\Http\Controllers\Webapps\UpdateWebappVariablesController;

Route::get('/', [IndexController::class, 'index']);

Route::prefix('webapps')->group(function() {
    Route::get('/', [WebappController::class, 'index']);
    Route::get('/create', [WebappController::class, 'create']);
    Route::post('/store', [WebappController::class, 'store']);
    Route::get('/{webapp}', [WebappController::class, 'show']);
    Route::get('/{webapp}/dockerimage', [WebappDockerConfigController::class, 'selectWebappDockerImage']);
    Route::get('/{webapp}/variables', ShowWebappVariablesController::class);
    Route::put('/{webapp}/dockerimage', [WebappController::class, 'updateImage']);
    Route::put('/{webapp}/variables/{variable}', UpdateWebappVariablesController::class);
});

Route::prefix('dockerimages')->group(function() {
    Route::get('/', [DockerImageController::class, 'index']);
    Route::get('/create', [DockerImageController::class, 'create']);
    Route::get('/{dockerimage}', [DockerImageController::class, 'show']);
    Route::get('/{dockerimage}/edit', [DockerImageController::class, 'edit']);
    Route::post('/', [DockerImageController::class, 'store']);
    Route::post('/{dockerimage}/variables/store', [DockerImageController::class, 'storeImageVariable']);
    Route::put('/{dockerimage}', [DockerImageController::class, 'update']);
    Route::delete('/{dockerimage}', [DockerImageController::class, 'destroy']);
});

Route::prefix('imagevariables')->group(function () {
    Route::put('/{imagevariable}', [ImageVariableController::class, 'update']);
    Route::delete('/{imagevariable}', [ImageVariableController::class, 'destroy']);
});

Route::prefix('gwmariadb')->group(function () {
    Route::get('/', [GwmariadbController::class, 'index']);
    Route::get('/store/{webapp}', [GwmariadbController::class, 'store']);
    Route::get('/delete/{webapp}', [GwmariadbController::class, 'destroy']);
    Route::get('/testconnection', TestGwmariadbConnectionController::class);
});

Route::prefix('bucket')->group(function() {
    Route::get('/store/{webapp}', CreateBucketController::class);
    Route::get('/delete/{webapp}', DeleteBucketController::class);
    Route::get('/test/{webapp}', TestConnectionBucketController::class);
});

Route::prefix('portainer')->group(function() {
    Route::get('/', [PortainerController::class, 'index']);
    Route::get('/{webapp}/store', [PortainerController::class, 'store']);
    Route::get('/{webapp}/update', [PortainerController::class, 'update']);
});