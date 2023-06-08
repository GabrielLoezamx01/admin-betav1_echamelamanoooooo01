<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ComentariosController;

Route::view('login_client','site.login');
Route::view('crear_client','site.create');
Route::post('login_client',[ClientsController::class, 'login'])->name('login_client');
Route::post('crear_cliente',[ClientsController::class, 'crear'])->name('crear_cliente');

Route::middleware(['clientsMiddleware'])->group(function () {
    Route::post('data_clients',[ClientsController::class, 'data_clients'])->name('data_clients');
    Route::get('Bienvenido',[ClientsController::class , 'site']);
    Route::resource('Api_publications', PublicacionesController::class);
    Route::resource('Api_comments', ComentariosController::class);
    Route::get('close_session',[ClientsController::class, 'close_sessions']);
    Route::get('comments', [ComentariosController::class, 'index']);
    Route::post('newComment', [ComentariosController::class, 'store'])->name('newComment');

});




