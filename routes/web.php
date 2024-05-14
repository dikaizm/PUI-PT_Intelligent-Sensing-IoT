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

    Route::middleware('can:mengelola-pengguna')->group(function () {
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
    });

    Route::middleware('can:mengelola-pengaturan')->group(function () {
        // Rute-rute yang memerlukan kedua middleware 'auth' dan 'can:mengelola-pengaturan' ditempatkan di sini
        //pengaturan jenis dokumen route
        Route::get('pengaturan/jenis-dokumen', [
            \App\Http\Controllers\JenisDokumenController::class,
            'index',
        ])->name('jenis-dokumen.index');
        Route::post('pengaturan/jenis-dokumen/store', [
            \App\Http\Controllers\JenisDokumenController::class,
            'store',
        ])->name('jenis-dokumen.store');
        Route::put('pengaturan/jenis-dokumen/{id}/update', [
            \App\Http\Controllers\JenisDokumenController::class,
            'update',
        ])->name('jenis-dokumen.update');
        Route::delete('pengaturan/jenis-dokumen/{id}/destroy', [
            \App\Http\Controllers\JenisDokumenController::class,
            'destroy',
        ])->name('jenis-dokumen.destroy');
        //end pengaturan jenis dokumen

        //pengaturan jenis penelitian
        Route::get('pengaturan/jenis-penelitian', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'index',
        ])->name('jenis-penelitian.index');
        Route::post('pengaturan/jenis-penelitian/store', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'store',
        ])->name('jenis-penelitian.store');
        Route::put('pengaturan/jenis-penelitian/{id}/update', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'update',
        ])->name('jenis-penelitian.update');
        Route::delete('pengaturan/jenis-penelitian/{id}/destroy', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'destroy',
        ])->name('jenis-penelitian.destroy');
        //end pengaturan jenis penelitian route

        //pengaturan mitra route
        Route::get('pengaturan/mitra', [
            \App\Http\Controllers\MitraController::class,
            'index',
        ])->name('mitra.index');
        Route::post('pengaturan/mitra/store', [
            \App\Http\Controllers\MitraController::class,
            'store',
        ])->name('mitra.store');
        Route::put('pengaturan/mitra/{id}/update', [
            \App\Http\Controllers\MitraController::class,
            'update',
        ])->name('mitra.update');
        Route::delete('pengaturan/mitra/{id}/destroy', [
            \App\Http\Controllers\MitraController::class,
            'destroy',
        ])->name('mitra.destroy');
        //end pengaturan mitra route

        //pengaturan publisher route
        Route::get('pengaturan/publisher', [
            \App\Http\Controllers\PublisherController::class,
            'index',
        ])->name('publisher.index');
        Route::post('pengaturan/publisher/store', [
            \App\Http\Controllers\PublisherController::class,
            'store',
        ])->name('publisher.store');
        Route::put('pengaturan/publisher/{id}/update', [
            \App\Http\Controllers\PublisherController::class,
            'update',
        ])->name('publisher.update');
        Route::delete('pengaturan/publisher/{id}/destroy', [
            \App\Http\Controllers\PublisherController::class,
            'destroy',
        ])->name('publisher.destroy');
        //end pengaturan publisher route

        //pengaturan publisher key route
        Route::post('pengaturan/publisher-key/store', [
            \App\Http\Controllers\PublisherKeyController::class,
            'store',
        ])->name('publisher-key.store');
        Route::put('pengaturan/publisher-key/{id}/update', [
            \App\Http\Controllers\PublisherKeyController::class,
            'update',
        ])->name('publisher-key.update');
        Route::delete('pengaturan/publisher-key/{id}/destroy', [
            \App\Http\Controllers\PublisherKeyController::class,
            'destroy',
        ])->name('publisher-key.destroy');
        //end pengaturan publisher key route

        //pengaturan status jurnal route
        Route::get('pengaturan/status-output', [
            \App\Http\Controllers\StatusOutputController::class,
            'index',
        ])->name('status-output.index');
        Route::post('pengaturan/status-output/store', [
            \App\Http\Controllers\StatusOutputController::class,
            'store',
        ])->name('status-output.store');
        Route::put('pengaturan/status-output/{id}/update', [
            \App\Http\Controllers\StatusOutputController::class,
            'update',
        ])->name('status-output.update');
        Route::delete('pengaturan/status-output/{id}/destroy', [
            \App\Http\Controllers\StatusOutputController::class,
            'destroy',
        ])->name('status-output.destroy');
        //end pengaturan status output route

        //pengaturan status penelitian route
        Route::get('pengaturan/status-penelitian', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'index',
        ])->name('status-penelitian.index');
        Route::post('pengaturan/status-penelitian/store', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'store',
        ])->name('status-penelitian.store');
        Route::put('pengaturan/status-penelitian/{id}/update', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'update',
        ])->name('status-penelitian.update');
        Route::delete('pengaturan/status-penelitian/{id}/destroy', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'destroy',
        ])->name('status-penelitian.destroy');
        //end pengaturan status penelitian route

        //pengaturan status penelitian key route
        Route::post('pengaturan/status-penelitian-key/store', [
            \App\Http\Controllers\StatusPenelitianKeyController::class,
            'store',
        ])->name('status-penelitian-key.store');
        Route::put('pengaturan/status-penelitian-key/{id}/update', [
            \App\Http\Controllers\StatusPenelitianKeyController::class,
            'update',
        ])->name('status-penelitian-key.update');
        Route::delete('pengaturan/status-penelitian-key/{id}/destroy', [
            \App\Http\Controllers\StatusPenelitianKeyController::class,
            'destroy',
        ])->name('status-penelitian-key.destroy');
        //end pengaturan status penelitian key route
    });
    //end mengelola-pengaturan middleware
    //penelitian route
    Route::get('penelitian', [
        \App\Http\Controllers\PenelitianController::class,
        'index',
    ])->name('penelitian.index');
    Route::post('penelitian/store', [
        \App\Http\Controllers\PenelitianController::class,
        'store',
    ])->name('penelitian.store');
    Route::put('penelitian/{id}/update', [
        \App\Http\Controllers\PenelitianController::class,
        'update',
    ])->name('penelitian.update');
    Route::delete('penelitian/{id}/destroy', [
        \App\Http\Controllers\PenelitianController::class,
        'destroy',
    ])->name('penelitian.destroy');
    //end penelitian route
});
