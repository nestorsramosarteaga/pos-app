<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PresentacionController;
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
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');
// Route::view('/categorias', 'categoria.index')->name('categorias');

Route::resource('categorias',CategoriaController::class);
Route::resource('marcas',MarcaController::class);
Route::resource('presentaciones',PresentacionController::class);


Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});

// Route::get('/lang',[LanguageController::class, 'change'])->name('user.lang');

