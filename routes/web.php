<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Search
    Route::get('/search', [SearchController::class, 'search'])
        ->name('search')
        ->middleware(['throttle:30,1']); // Limit to 30 searches per minute

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Pengaduan (Masyarakat)
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::post('/pengaduan/{id}/tanggapan', [PengaduanController::class, 'addTanggapan'])
        ->name('pengaduan.tanggapan')
        ->middleware(['throttle:6,1']); // Limit to 6 tanggapan per minute

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Pengaduan Management
        Route::get('/pengaduan', [AdminController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [AdminController::class, 'showPengaduan'])->name('pengaduan.show');
        Route::put('/pengaduan/{id}/status', [AdminController::class, 'updateStatus'])->name('pengaduan.update-status');
        Route::post('/pengaduan/{id}/tanggapan', [AdminController::class, 'addTanggapan'])->name('pengaduan.tanggapan');

        // Kategori Management
        Route::get('/kategori', [AdminController::class, 'kategoriIndex'])->name('kategori.index');
        Route::post('/kategori', [AdminController::class, 'kategoriStore'])->name('kategori.store');
        Route::put('/kategori/{id}', [AdminController::class, 'kategoriUpdate'])->name('kategori.update');
        Route::delete('/kategori/{id}', [AdminController::class, 'kategoriDestroy'])->name('kategori.destroy');

        // User Management
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/list', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });
});
