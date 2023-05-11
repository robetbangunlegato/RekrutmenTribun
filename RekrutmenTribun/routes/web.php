<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PsikotesController;
use App\Http\Controllers\WawancaraController;

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
    return view('auth\login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('lamaran', LamaranController::class)->middleware(['auth']);
Route::resource('daftar', DaftarController::class)->middleware(['auth']);
Route::resource('rekapitulasiadministrasi',RekapController::class)->middleware(['auth']);
Route::get('/lamaran/{id}', 'LamaranController@show')->name('lamaran.show')->middleware(['auth']);
Route::post('daftar.showadmin', [DaftarController::class, 'showadmin'])->name('daftar.showadmin')->middleware(['auth']);
Route::resource('wawancara', WawancaraController::class)->middleware(['auth']);
Route::resource('psikotes',PsikotesController::class)->middleware(['auth']);
Route::post('/wawancara/{id}/acc',[WawancaraController::class,'acc'])->name('wawancara.acc')->middleware(['auth']);
require __DIR__.'/auth.php';
