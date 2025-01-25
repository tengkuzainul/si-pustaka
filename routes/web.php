<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);
Route::prefix('books')->group(function () {
    Route::get('/books-catalog', [LandingPageController::class, 'catalog'])->name('book.catalog');
    Route::get('/detail/{id}', [LandingPageController::class, 'bookDetail'])->name('book.detail');
});

Route::middleware(['auth', 'role:Superadmin'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/list', [UsersController::class, 'index'])->name('users');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('denda')->group(function () {
        Route::get('/setting', [DendaController::class, 'index'])->name('denda.setting');
        Route::put('/update', [DendaController::class, 'update'])->name('denda.update');
    });

    Route::prefix('laporan')->group(function () {
        Route::controller(LaporanController::class)->group(function () {
            Route::get('/form', 'formCetak')->name('cetak.form');
            Route::get('/transaksi', 'cetak')->name('cetak');
        });
    });
});

Route::middleware(['auth', 'role:Superadmin,Admin'])->group(function () {
    Route::get('/chart', [DashboardController::class, 'borrowingTotalPerMonth']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/setting', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/update-image', [ProfileController::class, 'updateProfileImage'])->name('profile.updateImage');
        Route::put('/reset-password', [ProfileController::class, 'resetPassword'])->name('profile.resetPassword');
    });

    Route::prefix('buku')->group(function () {
        Route::get('/list', [BukuController::class, 'index'])->name('buku');
        Route::get('/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/store', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/edit/{buku}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/update/{buku}', [BukuController::class, 'update'])->name('buku.update');
        Route::get('/show/{buku}', [BukuController::class, 'show'])->name('buku.show');
        Route::delete('/destroy/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');
    });

    Route::prefix('siswa')->group(function () {
        Route::get('/list', [SiswaController::class, 'index'])->name('siswa');
        Route::get('/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('/store', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/show/{id}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    });

    Route::prefix('kategori-buku')->group(function () {
        Route::get('/list', [KategoriBukuController::class, 'index'])->name('kategori');
        Route::post('/store', [KategoriBukuController::class, 'store'])->name('kategori.store');
        Route::put('/update/{id}', [KategoriBukuController::class, 'update'])->name('kategori.update');
        Route::delete('/delete/{id}', [KategoriBukuController::class, 'destroy'])->name('kategori.destroy');
    });



    Route::prefix('peminjaman')->group(function () {
        Route::get('/list', [PeminjamanController::class, 'index'])->name('peminjaman');
        Route::get('/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::delete('/deleted/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    });

    Route::prefix('pengembalian')->group(function () {
        Route::get('/list', [PengembalianController::class, 'index'])->name('pengembalian');
        Route::get('/detail/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
        Route::post('/request-pengembalian/save/{id}', [PengembalianController::class, 'store'])->name('pengembalian.store');
    });

    Route::prefix('notification')->group(function () {
        Route::get('/fetch', [NotificationController::class, 'fetchNotification'])->name('notification.fetch');
        Route::post('/read', [NotificationController::class, 'readNotification'])->name('notification.read');
        Route::delete('/delete/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
    });
});

require __DIR__ . '/auth.php';
