<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

// Route::resource('', SiswaController::class);
Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/', [SiswaController::class, 'store'])->name('siswa.store');