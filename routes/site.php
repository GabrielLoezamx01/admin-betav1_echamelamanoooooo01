<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionesController;

Route::view('Bienvenido', 'site.index');
Route::resource('Api_publications', PublicacionesController::class);
