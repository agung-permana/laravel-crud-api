<?php

use App\Http\Controllers\Api\DosenController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('dosen',[DosenController::class, 'index']);
Route::post('dosen/tambah', [DosenController::class, 'tambah']);
Route::post('dosen/update', [DosenController::class, 'update']);
Route::delete('dosen/hapus/{id}', [DosenController::class, 'hapus']);


