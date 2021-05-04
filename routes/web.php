<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

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
Route::get('/inicio', function () {
    return print("HOla, iniciando el proyecto");
})->middleware('auth');
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::resource('categoria',CategoriaController::class)
    ->middleware('auth');

Route::resource('venta',VentaController::class)
    ->middleware('auth');
Route::get('venta/print/{id}',[VentaController::class,'print']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');