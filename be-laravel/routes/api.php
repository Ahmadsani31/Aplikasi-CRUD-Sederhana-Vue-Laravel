<?php

use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\API\MahasiswaController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\XSSProtection;


Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->middleware(XSSProtection::class);;
    Route::post('login', [AuthController::class, 'login'])->middleware(XSSProtection::class);;
});

Route::group([
    'middleware' => [JwtMiddleware::class],
    'prefix' => 'v1'
], function () {

    Route::get('mahasiswa', [MahasiswaController::class, 'get']);
    Route::post('mahasiswa/store', [MahasiswaController::class, 'store'])->middleware(XSSProtection::class);;
    Route::get('mahasiswa/edit/{id}', [MahasiswaController::class, 'edit']);
    Route::put('mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->middleware(XSSProtection::class);;
    Route::delete('mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy']);
    Route::get('mahasiswa/total', [MahasiswaController::class, 'get_total']);

    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
});
