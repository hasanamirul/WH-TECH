<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;

// welcome = login page
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('doLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// dashboard only for authenticated superadmin
Route::middleware(['auth','superadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Master CRUD
Route::middleware(['auth','superadmin'])->group(function () {
    // Jenis Pegawai
    Route::get('/master/jenis-pegawai', [MasterController::class, 'jenisPegawai'])->name('master.jenisPegawai');
    Route::post('/master/jenis-pegawai', [MasterController::class, 'jenisPegawaiStore'])->name('master.jenisPegawai.store');
    Route::get('/master/jenis-pegawai/{id}/edit', [MasterController::class, 'jenisPegawaiEdit'])->name('master.jenisPegawai.edit');
    Route::put('/master/jenis-pegawai/{id}', [MasterController::class, 'jenisPegawaiUpdate'])->name('master.jenisPegawai.update');
    Route::delete('/master/jenis-pegawai/{id}', [MasterController::class, 'jenisPegawaiDelete'])->name('master.jenisPegawai.delete');

    
    // Status Pegawai
    Route::get('/master/status-pegawai', [MasterController::class, 'statusPegawai'])->name('master.statusPegawai');
    Route::post('/master/status-pegawai', [MasterController::class, 'statusPegawaiStore'])->name('master.statusPegawai.store');
    Route::get('/master/status-pegawai/{id}/edit', [MasterController::class, 'statusPegawaiEdit'])->name('master.statusPegawai.edit');
    Route::put('/master/status-pegawai/{id}', [MasterController::class, 'statusPegawaiUpdate'])->name('master.statusPegawai.update');
    Route::delete('/master/status-pegawai/{id}', [MasterController::class, 'statusPegawaiDelete'])->name('master.statusPegawai.delete');

    // Agama
    Route::get('/master/agama', [MasterController::class, 'agama'])->name('master.agama');
    Route::post('/master/agama', [MasterController::class, 'agamaStore'])->name('master.agama.store');
    Route::get('/master/agama/{id}/edit', [MasterController::class, 'agamaEdit'])->name('master.agama.edit');
    Route::put('/master/agama/{id}', [MasterController::class, 'agamaUpdate'])->name('master.agama.update');
    Route::delete('/master/agama/{id}', [MasterController::class, 'agamaDelete'])->name('master.agama.delete');

    // Unit
    Route::get('/master/unit', [MasterController::class, 'unit'])->name('master.unit');
    Route::post('/master/unit', [MasterController::class, 'unitStore'])->name('master.unit.store');
    Route::get('/master/unit/{id}/edit', [MasterController::class, 'unitEdit'])->name('master.unit.edit');
    Route::put('/master/unit/{id}', [MasterController::class, 'unitUpdate'])->name('master.unit.update');
    Route::delete('/master/unit/{id}', [MasterController::class, 'unitDelete'])->name('master.unit.delete');

    // Sub Unit
    Route::get('/master/subunit', [MasterController::class, 'subunit'])->name('master.subunit');
    Route::post('/master/subunit', [MasterController::class, 'subunitStore'])->name('master.subunit.store');
    Route::get('/master/subunit/{id}/edit', [MasterController::class, 'subunitEdit'])->name('master.subunit.edit');
    Route::put('/master/subunit/{id}', [MasterController::class, 'subunitUpdate'])->name('master.subunit.update');
    Route::delete('/master/subunit/{id}', [MasterController::class, 'subunitDelete'])->name('master.subunit.delete');
});
