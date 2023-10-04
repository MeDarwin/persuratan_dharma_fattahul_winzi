<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/auth/login');
});
Route::prefix('auth')->group(function () {
    /* ---------------------------------- AUTH ---------------------------------- */
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
Route::middleware('auth')->group(
    function () {
        /* -------------------------------- DASHBOARD ------------------------------- */
        Route::get('/dashboard', [DashboardController::class, 'index']);

        /* //*----------------------------- ONLY ADMIN ---------------------------- */
        Route::middleware('only_admin')->group(function () {
            /* ---------------------------------- USER ---------------------------------- */
            Route::get('/user', [UserController::class, 'index']);
            Route::get('/user/add', [UserController::class, 'indexAdd']);
            Route::get('/user/{id}/edit', [UserController::class, 'indexEdit']);
            Route::post('/user/add', [UserController::class, 'add']);
            Route::post('/user/{id}/edit', [UserController::class, 'update']);
            Route::delete('/user/{id}/delete', [UserController::class, 'destroy']);

            /* ------------------------------- JENIS SURAT ------------------------------ */
            Route::get('/surat/jenis', [JenisSuratController::class, 'index']);
            Route::get('/surat/jenis/add', [JenisSuratController::class, 'indexAdd']);
            Route::get('/surat/jenis/{id}/edit', [JenisSuratController::class, 'indexEdit']);
            Route::post('/surat/jenis/add', [JenisSuratController::class, 'add']);
            Route::post('/surat/jenis/{id}/edit', [JenisSuratController::class, 'update']);
            Route::delete('/surat/jenis/{id}/delete', [JenisSuratController::class, 'destroy']);
        });
        /* //*----------------------------- ONLY ADMIN ---------------------------- */

        /* ---------------------------------- SURAT --------------------------------- */
        Route::get('/surat', [SuratController::class, 'index']);
        Route::get('/surat/send', [SuratController::class, 'indexAdd']);
        Route::get('/surat/{id}/edit', [SuratController::class, 'indexEdit']);
        Route::post('/surat/add', [SuratController::class, 'add']);
        Route::get('/surat/download', [SuratController::class, 'download']);
        Route::post('/surat/{id}/edit', [SuratController::class, 'update']);
        Route::delete('/surat/{id}/delete', [SuratController::class, 'destroy']);
        Route::delete('/surat/{id}/file', [SuratController::class, 'deleteFile']);
        Route::post('/surat/{id}/file', [SuratController::class, 'updateFile']);
    }
);