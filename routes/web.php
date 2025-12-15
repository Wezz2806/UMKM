<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController; // Pastikan UserController di-import

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $pengajuanController = new \App\Http\Controllers\PengajuanController();
    $data = $pengajuanController->getPublicStatistics();
    return view('welcome')->with($data);
});

// Endpoint untuk statistik pengajuan per dusun (public)
Route::get('/statistik-dusun', [PengajuanController::class, 'getStatistikPerDusun'])->name('statistik.dusun');

// Rute untuk dashboard pengguna biasa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute yang memerlukan autentikasi pengguna (umum)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk formulir pengajuan dana (datadiri - Tahap 1)
    Route::get('/datadiri', [PengajuanController::class, 'create'])->name('pinjaman.create');
    Route::post('/datadiri', [PengajuanController::class, 'storeDiri'])->name('pinjaman.storeDiri');

    // Rute untuk formulir detail usaha (Tahap 2)
    Route::get('/lanjutkan-pengajuan/{pengajuan_nid}', [PengajuanController::class, 'createDetails'])->name('pinjaman.createDetails');
    Route::post('/lanjutkan-pengajuan/{pengajuan_nid}', [PengajuanController::class, 'storeDetails'])->name('pinjaman.storeDetails');

    // Rute untuk halaman status pengajuan pengguna
    Route::get('/status', [PengajuanController::class, 'showStatus'])->name('pinjaman.status');
});

// Rute Khusus Admin
Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Rute admin untuk mengelola semua pengajuan
    Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
        Route::get('/', [PengajuanController::class, 'indexAdmin'])->name('index'); // Menampilkan semua pengajuan
        Route::get('/{pengajuan}/edit', [PengajuanController::class, 'editPengajuan'])->name('edit'); // Menampilkan form edit pengajuan
        Route::put('/{pengajuan}', [PengajuanController::class, 'updatePengajuan'])->name('update'); // Memproses update pengajuan
        Route::delete('/{pengajuan}', [PengajuanController::class, 'destroyPengajuan'])->name('destroy'); // Menghapus pengajuan
        Route::patch('/{pengajuan}/update-status', [PengajuanController::class, 'updateStatusPengajuan'])->name('updateStatus'); // Mengubah status pengajuan
    });

    // Rute admin untuk mengelola pengguna
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); // Menampilkan daftar pengguna
        // Contoh: Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy'); // Jika ingin mengaktifkan hapus user
    });
});

require __DIR__.'/auth.php';
