<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalAuditController;
use App\Models\JadwalAudit;
use App\Http\Controllers\AuditIndicatorController;
use App\Models\AuditSchedule;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuditLapanganController;
use App\Http\Controllers\PelaksanaanAuditController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelaporanHasilController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/audit/jadwalaudit', [DashboardController::class, 'audit'])->name('audit');
Route::get('/audit/pra_audit', [DashboardController::class, 'pra_audit'])->name('pra_audit');
Route::get('/audit/pelaksanaan_audit', [DashboardController::class, 'pelaksanaan'])->name('pelaksanaan');
Route::get('/audit/pelaporan_hasil_audit', [DashboardController::class, 'pelaporan'])->name('pelaporan');

// Route::get('/audit/jadwalaudit', [JadwalAuditController::class, 'index'])->name('jadwal.index');
// Route::get('/jadwal/create', [JadwalAuditController::class, 'create'])->name('jadwal.create');
// Route::post('/jadwal', [JadwalAuditController::class, 'store'])->name('jadwal.store');
// Route::post('/jadwal', [JadwalAuditController::class, 'edit'])->name('jadwal.edit');
// Route::post('/jadwal', [JadwalAuditController::class, 'destroy'])->name('jadwal.destroy');
Route::put('/jadwal/{id}', [JadwalAuditController::class, 'update'])->name('jadwal.update');
Route::get('/audit/jadwalaudit', [JadwalAuditController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal/create', [JadwalAuditController::class, 'create'])->name('jadwal.create'); // optional, bisa dihapus
Route::post('/jadwal', [JadwalAuditController::class, 'store'])->name('jadwal.store');
Route::get('/jadwal/{id}/edit', [JadwalAuditController::class, 'edit'])->name('jadwal.edit');
Route::put('/jadwal/{id}', [JadwalAuditController::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal/{id}', [JadwalAuditController::class, 'destroy'])->name('jadwal.destroy');


// Route::get('/audit/pra_audit', [AuditIndicatorController::class, 'index'])->name('pra_audit.index');
// Route::post('/audit/pra_audit/store', [AuditIndicatorController::class, 'store'])->name('pra_audit.store');
// Route::put('/audit/pra_audit/update/{id}', [AuditIndicatorController::class, 'update'])->name('pra_audit.update');
// Route::delete('/audit/pra_audit/delete/{id}', [AuditIndicatorController::class, 'destroy'])->name('pra_audit.destroy');

// Semua user login
Route::middleware(['auth'])->group(function () {

    // Auditee hanya bisa lihat (index khusus auditee)
    Route::get('/audit/pra_audit/auditee', [AuditIndicatorController::class, 'auditeeView'])->name('pra_audit.auditee.index');

    // Auditor & Lead Auditor bisa CRUD
    Route::middleware(['can_manage_audit'])->group(function () {
        Route::get('/audit/pra_audit', [AuditIndicatorController::class, 'index'])->name('pra_audit.index');
        Route::post('/audit/pra_audit/store', [AuditIndicatorController::class, 'store'])->name('pra_audit.store');
        Route::put('/audit/pra_audit/update/{id}', [AuditIndicatorController::class, 'update'])->name('pra_audit.update');
        Route::delete('/audit/pra_audit/delete/{id}', [AuditIndicatorController::class, 'destroy'])->name('pra_audit.destroy');
    });
});



Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
Route::get('/audit/create', [AuditController::class, 'create'])->name('audit.create');
Route::post('/audit', [AuditController::class, 'store'])->name('audit.store');

Route::get('/dashboard', [AuditController::class, 'index'])->name('dashboard');

Route::post('/audits', [AuditController::class, 'store'])->name('audits.store');
Route::get('/audits/{id}', [AuditController::class, 'show']);
Route::put('/audits/{id}', [AuditController::class, 'update'])->name('audits.update');
Route::delete('/audits/{id}', [AuditController::class, 'destroy'])->name('audits.destroy');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

Route::get('/audit/pelaksanaan_audit', [PelaksanaanAuditController::class, 'index'])->name('pelaksanaan');
Route::resource('pelaksanaan', PelaksanaanAuditController::class);

Route::delete('/pelaksanaan/{id}', [PelaksanaanAuditController::class, 'destroy'])->name('pelaksanaan.destroy');


Route::get('/audit/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan.index');

Route::get('audit/pelaporan_hasil_audit', [DashboardController::class, 'pelaporan'])->name('pelaporan');



Route::prefix('/audit/pra_audit')->name('pra_audit.')->group(function () {
    Route::get('/', [AuditIndicatorController::class, 'index'])->name('index');
    Route::post('/store', [AuditIndicatorController::class, 'store'])->name('store');
    Route::put('/update/{id}', [AuditIndicatorController::class, 'update'])->name('update');
    Route::resource('audit-indikator', AuditIndicatorController::class);
    Route::delete('/delete/{id}', [AuditIndicatorController::class, 'destroy'])->name('destroy');
});

Route::post('/jadwal', [JadwalAuditController::class, 'store'])->name('jadwal.store');

Route::prefix('/audit/pra_audit')->name('pra_audit.')->group(function () {
    Route::get('/', [AuditIndicatorController::class, 'index'])->name('index');
    Route::resource('audit-indikator', AuditIndicatorController::class);
});

Route::get('/dashboard/auditee', [DashboardController::class, 'auditee'])
    ->middleware('auth')
    ->name('dashboard.auditee');


Route::post('/auditee/upload-dokumen/{id}', [PelaksanaanAuditController::class, 'uploadDokumen'])->name('auditee.upload_dokumen');
Route::post('/auditor/tanggapan/{id}', [PelaksanaanAuditController::class, 'simpanTanggapan'])->name('auditor.tanggapan');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('audit')->group(function () {
    Route::get('/pelaporan_hasil_audit', [PelaporanHasilController::class, 'index'])->name('pelaporan.index');
    Route::post('/pelaporan_hasil_audit', [PelaporanHasilController::class, 'store'])->name('pelaporan.store');
    Route::delete('/pelaporan_hasil_audit/{id}', [PelaporanHasilController::class, 'destroy'])->name('pelaporan.destroy');
});

