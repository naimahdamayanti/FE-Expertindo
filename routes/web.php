<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\SertifikasiController;
use App\Http\Controllers\PublicController;


use App\Http\Controllers\DashboardController;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);

Route::post('/auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/auth/register', [RegisterController::class, 'register'])->name('register.submit');



Route::middleware(['verify.token'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Jadwal
    Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('jadwal/edit/{npm}', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('jadwal/update/{npm}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('jadwal/delete/{npm}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    // Artikel
    Route::get('artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('artikel/edit/{id}', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('artikel/update/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('artikel/delete/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

    // Training
    Route::get('training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::post('training', [TrainingController::class, 'store'])->name('training.store');
    Route::get('training/edit/{id}', [TrainingController::class, 'edit'])->name('training.edit');
    Route::put('training/update/{id}', [TrainingController::class, 'update'])->name('training.update');
    Route::delete('training/delete/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');

    // Staff
    Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('staff', [StaffController::class, 'store'])->name('staff.store');
    Route::get('staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

    // Testimoni
    Route::get('testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
    Route::get('testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
    Route::post('testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
    Route::get('testimoni/edit/{id}', [TestimoniController::class, 'edit'])->name('testimoni.edit');
    Route::put('testimoni/update/{id}', [TestimoniController::class, 'update'])->name('testimoni.update');
    Route::delete('testimoni/delete/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');

    // Sertifikasi
    Route::get('sertifikasi', [SertifikasiController::class, 'index'])->name('sertifikasi.index');
    Route::get('sertifikasi/{id}', [SertifikasiController::class, 'show'])->name('sertifikasi.show');
    Route::get('sertifikasi/jadwal/{id}', [SertifikasiController::class, 'jadwal'])->name('sertifikasi.jadwal');

    // Public Training
    Route::get('publictraining', [PublicController::class, 'index'])->name('publictraining.index');
    Route::get('publictraining/{id}', [PublicController::class, 'show'])->name('publictraining.show');
    Route::get('publictraining/jadwal/{id}', [PublicController::class, 'jadwal'])->name('publictraining.jadwal');
});
