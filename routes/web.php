<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\UsuariosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
include('login.php');
include('site.php');

Route::view('page', 'admin.page');
/*
* Categoria views
*/
Route::view('lista_categorias', 'admin.category.lista');
Route::resource('Api_category', CategoriasController::class);
// Route::get('categorias', function () {
//     return view('admin.category.index');
// });
// Route::get('admin', [ViewsControllers::class, 'viewBlade']);
/*
    * Usuarios List
*/
Route::resource('Api_users', UsuariosController::class);
Route::view('lista_usuarios', 'admin.usuarios.lista');

