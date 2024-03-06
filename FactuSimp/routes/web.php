<?php

use App\Http\Controllers\Cfdi;
use App\Http\Controllers\CfdiController;
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

Route::get('/cfdi', [CfdiController::class, 'index'])->name('cfdi.index');

Route::post('/create-cfdi', [CfdiController::class, 'create'])->name('cfdi.create');

Route::get('/list-cfdi', [CfdiController::class, 'list'])->name('cfdi.list');

