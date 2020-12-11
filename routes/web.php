<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/bienvenido', function () {
    return view('bienvenido');
});

// Route::get('/categoria', function () {
//     return view('categoria');
// });

Route::post('/', 'UserController@login')->name('user.login');

Route::resource('categoria', 'CategoriaController');
Route::get('categoria/{codcategoria}/confirmar','CategoriaController@confirmar')->name('categoria.confirmar');
Route::get('cancelar',function(){
    return redirect()->route('categoria.index')->with('datos','Accion Cancelada...!');
})->name('cancelar');

