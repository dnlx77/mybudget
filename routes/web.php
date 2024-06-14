<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OperazioneController;
use App\Http\Controllers\TagController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/{anno?}/{mese?}/{tag?}/{conto?}', [DashboardController::class, 'index1'])->name('dashboard1');

Route::get('operazioni/{operazione_id}/services/get-operazione', [OperazioneController::class, 'getOperazione'])->name('operazione.get_operazione_json');
Route::post('operazioni/inserisci', [OperazioneController::class, 'insert'])->name('operazione.insert');
Route::post('operazioni/edit', [OperazioneController::class, 'edit'])->name('operazione.edit');

Route::post('tags/inserisci', [TagController::class, 'insert'])->name('tag.insert');
Route::post('tags/edit', [TagController::class, 'edit'])->name('tag.edit');
Route::get('tags/{tags_id}/services/get-tag', [TagController::class, 'getTag'])->name('tag.get_tag_json');

