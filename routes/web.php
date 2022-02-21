<?php

use App\Http\Controllers\LoginApiController;
use App\Http\Livewire\Audit;
use App\Http\Livewire\Auditor;
use App\Http\Livewire\Biaya;
use App\Http\Livewire\DetailReg;
use App\Http\Livewire\LoginApi;
use App\Http\Livewire\Permohonan;
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
    Route::get('biaya', Biaya::class)->name('biaya');
    Route::get('audit', Audit::class)->name('audit');
    Route::get('auditor', Auditor::class)->name('auditor');
    Route::get('permohonan', Permohonan::class)->name('permohonan');
    Route::get('dreg/{reg_id}', DetailReg::class)->name('dreg');
});
