<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\ClientsController;

Route::get('Bienvenido',[ClientsController::class , 'site']);
Route::resource('Api_publications', PublicacionesController::class);
Route::view('login_client','site.login');
Route::view('crear_client','site.create');
Route::post('login_client',[ClientsController::class, 'login'])->name('login_client');
Route::post('crear_cliente',[ClientsController::class, 'crear'])->name('crear_cliente');
Route::post('data_clients',[ClientsController::class, 'data_clients'])->name('data_clients');


