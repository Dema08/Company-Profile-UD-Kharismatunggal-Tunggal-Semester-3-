<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DatapenggunaControllerapi;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\PengaturanApiController;
use App\Http\Controllers\Api\ArtikelApiController;
use App\Http\Controllers\Api\UlasanApiController;
use App\Http\Controllers\Api\FAQApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\KategoriApiController;
use App\Http\Controllers\Api\TagArtikelApiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('barang')->controller(BarangApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/getbarangbykategori', 'getbarangbykategori');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
Route::prefix('pengaturan')->controller(PengaturanApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/getbarangbykategori', 'getbarangbykategori');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
Route::prefix('artikel')->controller(ArtikelApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('kategori-barang')->controller(KategoriApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('tags')->controller(TagArtikelApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
// Public routes for authentication
Route::prefix('auth')->controller(AuthApiController::class)->group(function () {
    Route::post('/login', 'loginMethod');
    Route::post('/register', 'registerMethod');
    Route::post('/logout', 'logoutMethod');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->controller(AuthApiController::class)->group(function () {
        Route::post('/logout', 'logoutMethod');
    });
});


// Protected routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('pengguna')->controller(DatapenggunaControllerapi::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/findbyid', 'getuserbyid');
        Route::get('/findbyname', 'getuserbyname');
        Route::get('/findbyemail', 'getuserbyemail');
        Route::post('/store', 'store');
        Route::patch('/update/{id}', 'update');
        Route::delete('/delete/{id}', 'destroy');
    });
    // Route::prefix('barang')->controller(BarangApiController::class)->group(function () {
    //     Route::get('/', 'index');
    //     Route::post('/', 'store');
    //     Route::get('/{id}', 'show');
    //     Route::put('/{id}', 'update');
    //     Route::delete('/{id}', 'destroy');
    // });
});

