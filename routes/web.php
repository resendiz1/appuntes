<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\pasosController;
use App\Http\Controllers\apuntesController;
use App\Http\Controllers\comentariosController;

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
Route::get('apunte/{id}', [apuntesController::class, 'show'])->name('apunte.show');
Route::get('/editar/{apunte}', [apuntesController::class, 'edit'] )->name('apunte.edit');
Route::patch('/{apunte}', [apuntesController::class, 'update'])->name('apunte.update'); 

Route::get('/',[apuntesController::class, 'index'])->name('inicio');
Route::post('/apunte', [pasosController::class, 'store'])->name('pasos.store');

Route::post('/apunte/comment', [comentariosController::class, 'store'])->name('comment.store');
Route::post('/', [apuntesController::class, 'store'])->name('apunte.store');







Route::delete('inicio/{apunte}/apunte/', [apuntesController::class, 'destroy'])->name('apunte.destroy');







