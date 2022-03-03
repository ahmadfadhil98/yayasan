<?php

use App\Http\Livewire\Certificate;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\DetailAudit;
use App\Http\Livewire\DetailBiaya;
use App\Http\Livewire\DetailReg;
use App\Http\Livewire\HasilAudit;
use App\Http\Livewire\Referensi;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/',Dashboard::class)->name('dashboard');

    Route::get('referensi',Referensi::class)->name('referensi');
    Route::get('certificate', Certificate::class)->name('certificate');
    Route::get('dreg/{reg_id}/{status}', DetailReg::class)->name('dreg');
    Route::get('dbiaya/{reg_id}/{status}', DetailBiaya::class)->name('dbiaya');
    Route::get('daudit/{reg_id}/{status}', DetailAudit::class)->name('daudit');
    Route::get('haudit/{reg_id}/{status}', HasilAudit::class)->name('haudit');
});
