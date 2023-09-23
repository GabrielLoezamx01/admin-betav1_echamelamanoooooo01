<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProfileClienController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\sellerNotify;
use App\Http\Controllers\ViewSucursalController;
use App\Http\Controllers\ComentariosController;


/*
* Login para los dos roles.
*/
Route::view('login_client','site.login');
Route::post('login_client', [ClientsController::class, 'login'])->name('login_client');
Route::view('crear_client','site.create');
Route::post('crear_cliente',[ClientsController::class, 'crear'])->name('crear_cliente');

/*
* El midleware se utiliza para los dos roles.........
*
*/
Route::middleware(['clientsMiddleware'])->group(function () {
    /*
    * Lista de rutas del navbar del layouts.
    * Roles Usuarios = Vendedor y Cliente
    * La vista Bienvenido y profile lo utlizan los dos roles del sistema.
    * Todos son metodos GET.....
    */

    /*
    * Rutas de seccion Bienvenidos
    */
    Route::get('Bienvenido',   [ClientsController::class ,'site']);
    Route::post('data_clients',[ClientsController::class,'data_clients'])->name('data_clients');
    Route::get('close_session',[ClientsController::class,'close_sessions']);
    /*
    * Rutas de seccion Sucursales
    */
    Route::get('mis_sucursales',      [VendedorController::class,      'index']);
    Route::get('mis_sucursales/(id)', [VendedorController::class, 'show'])->name('mis_sucursales.show');
    Route::post('create_sucursal',    [VendedorController::class, 'store'])->name('create_sucursal');
    /*
    * Rutas de seccion Notificaciones
    */
    Route::get('notificaciones_vendedor', [sellerNotify::class,            'index']);


    /*
    * Rutas de seccion profile
    */
    Route::get('profile',                 [ProfileClienController::class,  'index']);

    /*
    * Archivo donde se guardan todos los ajuestes de api Resource.......
    *  Este archivo sirve para organizar los controllers.....+
    * Gabriel Loeza 4/09/2023 3:34 AM
    */
    include('resourcesApi.php');


    Route::get('comments',    [ComentariosController::class, 'index']);
    Route::post('newComment', [ComentariosController::class, 'store'])->name('newComment');
    Route::get('sucursal',    [ViewSucursalController::class, 'index'])->name('sucursal');
    Route::get('Sucursales',  [SucursalesController::class, 'index']);
});




