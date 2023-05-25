<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\PsikotesController;
use App\Http\Controllers\WawancaraController;
use App\Http\Controllers\PengumumanController;


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
    return view('auth.login');
});

Route::get('/lamaran', function () {
    return view('Lamaran.index');
})->middleware(['auth'])->name('lamaran');

Route::resource('lamaran', LamaranController::class)->middleware(['auth']);
Route::resource('daftar', DaftarController::class)->middleware(['auth']);
Route::resource('rekapitulasiadministrasi',RekapController::class)->middleware(['auth']);
Route::get('/lamaran/{id}', 'LamaranController@show')->name('lamaran.show')->middleware(['auth']);
Route::post('daftar.showadmin', [DaftarController::class, 'showadmin'])->name('daftar.showadmin')->middleware(['auth']);
Route::resource('wawancara', WawancaraController::class)->middleware(['auth']);
Route::resource('psikotes',PsikotesController::class)->middleware(['auth']);
Route::post('/wawancara/{id}/acc',[WawancaraController::class,'acc'])->name('wawancara.acc')->middleware(['auth']);
Route::resource('soal', SoalController::class)->middleware(['auth']);
Route::resource('pilihan', PilihanController::class)->middleware(['auth']);
Route::resource('tes', TesController::class)->middleware(['auth']);
Route::resource('pengumuman', PengumumanController::class)->middleware(['auth']);
require __DIR__.'/auth.php';
