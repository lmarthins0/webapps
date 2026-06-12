<?php

use App\Http\Controllers\Bucket\CreateBucketController;
use App\Http\Controllers\Bucket\DeleteBucketController;
use App\Http\Controllers\Bucket\TestConnectionBucketController;
use App\Http\Controllers\Gwmariadb\TestGwmariadbConnectionController;
use App\Http\Controllers\GwmariadbController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortainerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebappDockerConfigController;

Route::get('/', [IndexController::class, 'index']);

Route::prefix('webapps')->group(function() {
    Route::get('/', [WebappController::class, 'index']);
    Route::get('/create', [WebappController::class, 'create']);
    Route::post('/store', [WebappController::class, 'store']);
    Route::get('/{webapp}', [WebappController::class, 'show']);
    Route::get('/{webapp}/docker/create', [WebappDockerConfigController::class, 'create']);
    Route::get('/{webapp}/docker/edit', [WebappDockerConfigController::class, 'edit']);
    Route::post('/{webapp}/docker', [WebappDockerConfigController::class, 'store']);
    Route::put('/{webapp}/docker/update', [WebappDockerConfigController::class, 'update']);
});

# reunião
//Route::get('/portainer', [ReuniaoController::class, 'portainer']);
//Route::get('/gwmariadb', [ReuniaoController::class, 'gwmariadb']);
//Route::get('/rustfs/{app}', [ReuniaoController::class, 'rustfs']);

#Route::resource('gwmariadb', GwmariadbController::class);
#Route::resource('portainer', PortainerController::class);

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
    Route::get('/store', [PortainerController::class, 'store']);
    Route::get('/update', [PortainerController::class, 'update']);
});