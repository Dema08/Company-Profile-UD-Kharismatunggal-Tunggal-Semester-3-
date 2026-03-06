<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatapenggunaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\TagArtikelController;
use App\Http\Controllers\KategoriArtikelController;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::resource('pengguna', DatapenggunaController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('kategori_barang', KategoriBarangController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::controller(UlasanController::class)->group(function () {
        Route::get('/ulasan', 'index')->name('ulasan.index');
        Route::get('/ulasan/{id}', 'ulasanpage')->name('ulasan.approvepage');
        Route::patch('/ulasan/update-approval/{id}', 'updateStatus')->name('ulasan.approveulasan');
        Route::delete('/ulasan/destroy/{id}', 'destroy')->name('ulasan.destroy');
    });
    Route::resource('faq', FAQController::class);
    Route::resource('tags', TagArtikelController::class);
    Route::resource('partners', PartnerController::class);
    Route::controller(PengaturanController::class)->group(function () {
        Route::get('pengaturan','index')->name('pengaturan.index');
        Route::patch('/pengaturan/{id}', 'update')->name('pengaturan.update');
        Route::post('/pengaturan/heroimage', 'storeHeroImage')->name('pengaturan.storeheroimage');
        Route::post('/pengaturan/heroimage/{id}', 'updateHeroImage')->name('pengaturan.updateheroimage');
        Route::delete('/pengaturan/heroimage/{id}', 'deleteHeroImage')->name('pengaturan.deleteheroimage');
    });
});

// Ulasan routes
Route::post('/ulasan/store/{id}', [UlasanController::class, 'store'])->name('store.ulasan');

// Authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.view');
    Route::post('/login', 'loginMethod')->name('auth.loginMethod');
    Route::post('/logout', 'logout')->name('auth.logout');
    Route::post('/register', 'registerMethod')->name('auth.registerMethod');
    Route::get('/forgot-password', 'forgotPasswordView')->name('auth.forgotPassword');
    Route::post('/forgot-password', 'forgotPasswordMethod')->name('auth.forgotPasswordMethod');
});

// Password reset routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// User routes
Route::controller(homecontroller::class)->group(function () {
    Route::get('/', 'index')->name('users.index');
    Route::get('/about', 'about')->name('users.about');
    Route::get('/faq', 'faq')->name('users.faq');
    Route::get('/artikel', 'artikel')->name('users.artikel');
    Route::get('/barang', 'barang')->name('users.barang');
    Route::get('/barang/detail/{id}', 'barang_detail')->name('users.barangdetail');
    Route::get('/artikel/detail/{id}', 'artikel_detail')->name('users.artikeldetail');
    Route::get('/artikel/search', 'searchartikel')->name('users.searchartikel');
    Route::get('/barang/search', 'searchbarang')->name('users.searchbarang');
    Route::get('/faq/search', 'searchfaq')->name('users.searchpertanyaan');
});
