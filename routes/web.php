<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [
        \App\Http\Controllers\UserController::class,
        'index',
    ])->name('users.index');

    Route::post('user/store', [
        \App\Http\Controllers\UserController::class,
        'store',
    ])->name('user.store');

    Route::put('user/{id}/update', [
        \App\Http\Controllers\UserController::class,
        'update',
    ])->name('user.update');

    Route::delete('user/{id}/delete', [
        \App\Http\Controllers\UserController::class,
        'destroy',
    ])->name('user.delete');

    Route::get('profile', [
        \App\Http\Controllers\ProfileController::class,
        'show',
    ])->name('profile.show');

    Route::put('profile', [
        \App\Http\Controllers\ProfileController::class,
        'update',
    ])->name('profile.update');

    Route::get('laporan-kinerja', [
        \App\Http\Controllers\LaporanKinerjaController::class,
        'index',
    ])->name('laporan-kinerja.index');

    Route::get('pengaturan/jenis-output', [
        \App\Http\Controllers\JenisOutputController::class,
        'index',
    ])->name('jenis-output.index');

    Route::get('pengaturan/jenis-penelitian', [
        \App\Http\Controllers\JenisPenelitianController::class,
        'index',
    ])->name('jenis-penelitian.index');
});
