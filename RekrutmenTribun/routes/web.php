<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LandingController;
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

Route::resource('lamaran', LamaranController::class);
Route::resource('daftar', DaftarController::class);
Route::get('/lamaran/{id}', 'LamaranController@show')->name('lamaran.show');
Route::post('/daftar.showadmin', [DaftarController::class, 'showadmin'])->name('daftar.showadmin');


