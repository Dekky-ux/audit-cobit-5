<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JawabanRespondenController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\SistemInformasiController;
use App\Http\Controllers\UserController;
use App\Models\SistemInformasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication Route
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/logout', [AuthController::class, 'handleLogout'])->middleware('auth');

Route::get('/dashboard', function () {
    if(Auth::user()->role === "AUDITOR"){
        $data = SistemInformasi::latest()->get();
        return view('dashboard', [
            "data" => $data
        ]);
    }else{
        return view('dashboardResponden');
    }
})->middleware('auth');

// User Route
Route::get('/pengguna', [UserController::class, "index"])->middleware("auth");
Route::post('/pengguna', [UserController::class, "create"])->middleware("auth");
Route::put('/pengguna', [UserController::class, "update"])->middleware("auth");
Route::get('/pengguna/delete', [UserController::class, "delete"])->middleware("auth");

// Kuesioner Route
Route::get('/kuesioner', [KuesionerController::class, "index"])->middleware("auth");
Route::post('/kuesioner', [KuesionerController::class, "create"])->middleware("auth");
Route::put('/kuesioner', [KuesionerController::class, "update"])->middleware("auth");
Route::get('/kuesioner/delete', [KuesionerController::class, "delete"])->middleware("auth");

// Isi Kuesioner Route
Route::get('/isi-kuesioner', [JawabanRespondenController::class, "index"])->middleware("auth");
Route::post('/isi-kuesioner', [JawabanRespondenController::class, "create"]);


// Rekapitulasi Route
Route::get('/sistem-informasi', [SistemInformasiController::class, "index"])->middleware("auth");
Route::post('/sistem-informasi', [SistemInformasiController::class, "create"])->middleware("auth");
Route::put('/sistem-informasi', [SistemInformasiController::class, "update"])->middleware("auth");
Route::get('/sistem-informasi/delete', [SistemInformasiController::class, "delete"])->middleware("auth");

Route::get('/sistem-informasi/detail', [SistemInformasiController::class, "detail"])->middleware("auth");
Route::get('/cetak', [SistemInformasiController::class, "cetak"])->name("cetak")->middleware("auth");
