<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JenisPegawaiController;
use App\Http\Controllers\Api\StatusPegawaiController;
use App\Http\Controllers\Api\AgamaController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\SubUnitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Master Data Routes
Route::apiResource('jenis-pegawai', JenisPegawaiController::class);
Route::apiResource('status-pegawai', StatusPegawaiController::class);
Route::apiResource('agama', AgamaController::class);
Route::apiResource('unit', UnitController::class);
Route::apiResource('sub-unit', SubUnitController::class);
