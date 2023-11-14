<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuejaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\AsignarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/quejas', QuejaController::class)->names('quejas');
    Route::resource('/roles', RoleController::class)->names('roles');
    Route::resource('/permisos', PermisoController::class)->names('permisos');
    Route::get('/permisos/{id}/edit', 'PermisoController@edit');
    Route::resource('/asignar', AsignarController::class)->names('asignar');
    Route::post('/quejas/guardarSeguimiento', [QuejaController::class, 'guardarSeguimiento'])->name('quejas.guardarSeguimiento');
});
