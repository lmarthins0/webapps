<?php

use App\Http\Controllers\AppDatabase\AppDatabaseController;
use App\Http\Controllers\Bucket\BucketController;
use App\Http\Controllers\Bucket\CreateBucketController;
use App\Http\Controllers\Bucket\DeleteBucketController;
use App\Http\Controllers\Bucket\TestConnectionBucketController;
use App\Http\Controllers\Dockerimage\ImageVariableController;
use App\Http\Controllers\DockerImageController;
use App\Http\Controllers\EditWebappImageController;
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
    Route::get('/{webapp}/dockerimage', EditWebappImageController::class);
    Route::get('/{webapp}/variables', ShowWebappVariablesController::class);
    Route::get('/{webapp}/database/store', [GwmariadbController::class, 'store']);
    Route::get('/{webapp}/bucket/store', [BucketController::class, 'store']);
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
    Route::get('/testconnection', TestGwmariadbConnectionController::class);
    Route::get('/{appdatabase}', [GwmariadbController::class, 'show']);
    Route::put('/{appdatabase}', [GwmariadbController::class, 'update']);
    Route::delete('/{appdatabase}', [GwmariadbController::class, 'destroy']);
});

Route::prefix('bucket')->group(function() {
    Route::get('/test', TestConnectionBucketController::class);
    Route::get('/{bucket}', [BucketController::class, 'show']);
    Route::delete('/{bucket}', [BucketController::class, 'destroy']);
});

Route::prefix('portainer')->group(function() {
    Route::get('/', [PortainerController::class, 'index']);
    Route::get('/{webapp}/store', [PortainerController::class, 'store']);
    Route::get('/{webapp}/update', [PortainerController::class, 'update']);
});