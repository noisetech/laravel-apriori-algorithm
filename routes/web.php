<?php

use App\Http\Controllers\ApoririController;
use App\Http\Controllers\DashobardController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
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
    return redirect()->route('login');
});

Route::prefix('admin')
    ->group(function () {
        Route::get('/', [DashobardController::class, 'index'])
            ->name('dashboard');

        Route::get('transaksi', [TransaksiController::class, 'index'])
            ->name('transaksi');
        Route::get('transaksi.data', [TransaksiController::class, 'data'])
            ->name('transaksi.data');
        Route::post('transaksi.import', [TransaksiController::class, 'import'])
            ->name('transaksi.import');

        Route::get('form_bagian_aporiri', [ApoririController::class, 'form'])
            ->name('form_bagian_aporiri');
        Route::post('proses_aporiri', [ApoririController::class, 'proses_aporiri'])
            ->name('aporiri.proses');
        Route::get('export-itemset-1', [ApoririController::class, 'exportItemset1'])
            ->name('exportItemset1');
        Route::get('exportElminasiItemset1/{support}', [ApoririController::class, 'exportElminasiItemset1'])
        ->name('exportElminasiItemset1');
        Route::get('export-itemset-2', [ApoririController::class, 'exportItemset2'])
            ->name('export-itemset-2');
        Route::get('exportElminasiItemset2/{support}', [ApoririController::class, 'exportElminasiItemset2'])
        ->name('exportElminasiItemset2');
        Route::get('export-itemset-3', [ApoririController::class, 'exportItemset3'])
        ->name('export-itemset-3');
        Route::get('export-itemset-4', [ApoririController::class, 'exportItemset4'])
        ->name('export-itemset-4');

    });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
