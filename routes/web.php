<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OperazioneController;

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
    return view('welcome');
});

Route::get('dashboard/{anno?}/{mese?}/{tag?}', [DashboardController::class, 'index'])->name('dashboard');
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('operazioni/create', [OperazioneController::class, 'create'])->name('operazione.create');
Route::get('operazioni/{operazione_id}/services/get-operazione', [OperazioneController::class, 'getOperazione'])->name('operazione.get_operazione_json');
Route::post('operazioni/inserisci', [OperazioneController::class, 'insert'])->name('operazione.insert');
Route::post('operazioni/edit', [OperazioneController::class, 'edit'])->name('operazione.edit');
