<?php

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;

// ==================== DEFAULT REDIRECT =====================
Route::get('/', fn () => redirect('/login'));

// ==================== AUTH =====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();       
    $request->session()->regenerateToken();  
    return redirect('/login');
})->name('logout');



// ==================== ADMIN AREA =====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Resources
    Route::resources([
        'guru' => GuruController::class,
        'siswa' => SiswaController::class,
        'mapel' => MapelController::class,
        'kelas' => KelasController::class,
        'nilai' => NilaiController::class, 
    ]);
});

// ==================== GURU AREA =====================
Route::middleware(['auth', 'role:admin,guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::resource('nilai', NilaiController::class)->except(['destroy']); 
});

// ==================== SISWA AREA =====================
Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index'); 
});
