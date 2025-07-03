<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicKkController;
use App\Http\Controllers\Admin\KeluargaController as AdminKeluargaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Models\Keluarga; // Import model Keluarga
use App\Models\User;     // Import model User

// Halaman Welcome
Route::get('/', [PublicKkController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    $jumlahKeluarga = Keluarga::count();
    $jumlahAdmin = User::count();

    return view('dashboard', [
        'jumlahKeluarga' => $jumlahKeluarga,
        'jumlahAdmin' => $jumlahAdmin,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route untuk RUD Data Keluarga (Create tidak ada di admin)
    Route::resource('keluarga', AdminKeluargaController::class)->except(['create', 'store']);
    
    // Route untuk CRUD Data Admin/User
    Route::resource('users', AdminUserController::class);
});

// Halaman Form Buat KK
Route::get('/buat-kk', [PublicKkController::class, 'create'])->name('kk.create');

// Menyimpan data KK
Route::post('/buat-kk', [PublicKkController::class, 'store'])->name('kk.store');

// Halaman Sukses dan Download PDF
Route::get('/kk/{keluarga}/sukses', [PublicKkController::class, 'success'])->name('kk.success');
Route::get('/kk/{keluarga}/download', [PublicKkController::class, 'downloadPdf'])->name('kk.download');

require __DIR__.'/auth.php';
