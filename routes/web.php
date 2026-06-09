<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\WebappController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReuniaoController;

Route::get('/', [IndexController::class, 'index']);

Route::get('/webapps', [WebappController::class, 'index']);
Route::get('/webapps/create', [WebappController::class, 'create']);
Route::post('/webapps/store', [WebappController::class, 'store']);
Route::get('/webapps/{webapp}', [WebappController::class, 'show']);


# reunião
Route::get('/portainer', [ReuniaoController::class, 'portainer']);
Route::get('/gwmariadb', [ReuniaoController::class, 'gwmariadb']);
Route::get('/rustfs/{app}', [ReuniaoController::class, 'rustfs']);



