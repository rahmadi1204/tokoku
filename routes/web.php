<?php

use App\Http\Controllers\Data\UserController;
use App\Http\Controllers\Page\DashboardController;
use App\Http\Controllers\Setting\AppController;
use App\Http\Controllers\Setting\RouteController;
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

Route::get('/', [RouteController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/setting', [AppController::class, 'index'])->name('setting');
    Route::get('/setting/name', [AppController::class, 'appName'])->name('setting.app.name');
    Route::get('/setting/cekpassword', [AppController::class, 'cekPassword'])->name('setting.app.cekpassword');
    Route::post('/setting/save', [AppController::class, 'appStore'])->name('setting.app.store');
    Route::post('/setting/upload', [AppController::class, 'logoStore'])->name('setting.logo.store');
    Route::post('/setting/user/delete', [UserController::class, 'destroy'])->name('setting.user.delete');
});

require __DIR__ . '/auth.php';
