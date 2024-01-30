<?php

use App\Http\Controllers\KembaliMobilController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PinjamMobilController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/mobil/index', [MobilController::class, 'index'])->name('mobil.index');
Route::get('/admin/mobil/create', [MobilController::class, 'create'])->name('mobil.create');
Route::post('/admin/mobil/create', [MobilController::class, 'store'])->name('mobil.store');
Route::get('/admin/mobil/edit/{mobil}', [MobilController::class, 'edit'])->name('mobil.edit');
Route::put('/admin/mobil/edit/{mobil}', [MobilController::class, 'update'])->name('mobil.update');
Route::delete('/admin/mobil/index/{mobil}', [MobilController::class, 'destroy'])->name('mobil.destroy');
Route::get('/mobil/sewa-mobil/{mobil}', [PinjamMobilController::class, 'create'])->name('mobil.sewa.create');
Route::post('/mobil/sewa-mobil/{mobil}', [PinjamMobilController::class, 'store'])->name('mobil.sewa.store');
Route::get('/mobil/sewa-mobil/detail/{mobil}', [PinjamMobilController::class, 'show'])->name('mobil.sewa.show');
// Route::delete('/admin/mobil/index/{mobil}', [MobilController::class, 'destroy'])->name('mobil.destroy');

Route::get('/mobil/sewa/index/{user}', [PinjamMobilController::class, 'index'])->name('mobil.sewa.index');
Route::put('/mobil/sewa/index/kembali/{mobil}', [KembaliMobilController::class, 'destroy'])->name('mobil.sewa.kembali');
Route::put('/mobil/sewa/index/confirm/{mobil}', [MobilController::class, 'confirm'])->name('mobil.sewa.confirm');
