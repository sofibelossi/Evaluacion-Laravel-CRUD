<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
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
    return redirect()->route('medicamentos.index');
});
Route::resource('medicamentos','App\Http\Controllers\MedicamentoController');

Route::get('/buscar', [App\Http\Controllers\MedicamentoController::class, 'buscar'])->name('buscar');

Route::view('/login', 'medicamento.auth.login')->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::view('/register', 'medicamento.auth.register')->name('register');
Route::post('/register', [RegisterController::class, 'store']);
