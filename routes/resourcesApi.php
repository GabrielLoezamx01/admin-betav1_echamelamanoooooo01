<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\ApiServiciesControlller;
use App\Http\Controllers\apiSucursalesController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\SharedPostController;
use App\Http\Controllers\notificacionesController;
use App\Http\Controllers\ListSucursalesController;
use App\Http\Controllers\ComentariosController;


Route::resource('Api_publications', PublicacionesController::class);
Route::resource('Api_comments', ComentariosController::class);
Route::resource('api_servicios', ApiServiciesControlller::class);
Route::resource('api_sucursales', apiSucursalesController::class);
Route::resource('likes_api', LikesController::class);
Route::resource('shared_post', SharedPostController::class);
Route::resource('api_notificaciones', notificacionesController::class);
Route::resource('list_Sucursales', ListSucursalesController::class);
