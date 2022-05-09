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
    return view('welcome');
});

Route::get('/all', [AplikasiController::class, 'all']);

Route::get('/input-beasiswa-1', [AplikasiController::class, 'inputBeasiswa1']);
Route::get('/input-beasiswa-2', [AplikasiController::class, 'inputBeasiswa2']);

Route::get('/tampil-beasiswa-1', [AplikasiController::class, 'tampilBeasiswa1']);
Route::get('/tampil-beasiswa-2', [AplikasiController::class, 'tampilBeasiswa2']);
Route::get('/tampil-beasiswa-3', [AplikasiController::class, 'tampilBeasiswa3']);
Route::get('/tampil-beasiswa-4', [AplikasiController::class, 'tampilBeasiswa4']);

Route::get('/wherehasmorph-1', [AplikasiController::class, 'wherehasmorph1']);
Route::get('/wherehasmorph-2', [AplikasiController::class, 'wherehasmorph2']);

Route::get('/update-beasiswa-1', [AplikasiController::class, 'updateBeasiswa1']);
Route::get('/update-beasiswa-2', [AplikasiController::class, 'updateBeasiswa2']);

Route::get('/delete', [AplikasiController::class, 'delete']);
