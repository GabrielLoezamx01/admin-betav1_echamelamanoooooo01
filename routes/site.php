<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\ProfileClienController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\notificacionesController;
use App\Http\Controllers\VendedorController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\sellerNotify;
use App\Http\Controllers\ApiServiciesControlller;
use App\Http\Controllers\apiSucursalesController;
use App\Http\Controllers\ListSucursalesController;

Route::view('login_client','site.login');
Route::view('crear_client','site.create');
Route::post('login_client',[ClientsController::class, 'login'])->name('login_client');
Route::post('crear_cliente',[ClientsController::class, 'crear'])->name('crear_cliente');



Route::get('/auth/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);
Route::get('/auth/google/register', [RegisteredUserController::class, 'redirectToGoogle'])->name('auth.google.register');
Route::get('/auth/google/callback/register', [RegisteredUserController::class, 'handleGoogleCallback']);

Route::middleware(['clientsMiddleware'])->group(function () {
    Route::post('data_clients',[ClientsController::class, 'data_clients'])->name('data_clients');
    Route::get('Bienvenido',[ClientsController::class , 'site']);

    Route::resource('Api_publications', PublicacionesController::class);
    Route::resource('Api_comments', ComentariosController::class);
    Route::resource('api_servicios', ApiServiciesControlller::class);
    Route::resource('api_sucursales', apiSucursalesController::class);


    Route::get('close_session',[ClientsController::class, 'close_sessions']);
    Route::get('comments', [ComentariosController::class, 'index']);
    Route::post('newComment', [ComentariosController::class, 'store'])->name('newComment');
    // setting profile clients rols
    Route::get('profile', [ProfileClienController::class, 'index']);
    Route::get('Sucursales', [SucursalesController::class, 'index']);

    // Route::view('Sucursales','site.sucursales');
    // Route::resource('api_sucursales', SucursalesController::class);
    Route::resource('api_notificaciones', notificacionesController::class);
    // Se cambio el nombre cambio de idea 21/07/2023 se llama las sucursales del vendedor.
    Route::get('mis_sucursales', [VendedorController::class, 'index']);
    Route::post('create_sucursal', [VendedorController::class, 'store'])->name('create_sucursal');
    Route::resource('list_Sucursales', ListSucursalesController::class);
    // vendedores......
    Route::get('notificaciones_vendedor', [sellerNotify::class, 'index']);

});




