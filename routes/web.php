<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisOutputController;
use App\Http\Middleware\EnsureAuthorPenelitian;
use App\Http\Controllers\JenisOutputKeyController;

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

    Route::get('users/search', [
        \App\Http\Controllers\UserController::class,
        'search',
    ]);

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

        //master-data skema route
        Route::get('master-data/skema', [
            \App\Http\Controllers\SkemaController::class,
            'index',
        ])->name('skema.index');
        Route::post('master-data/skema/store', [
            \App\Http\Controllers\SkemaController::class,
            'store',
        ])->name('skema.store');
        Route::put('master-data/skema/{id}/update', [
            \App\Http\Controllers\SkemaController::class,
            'update',
        ])->name('skema.update');
        Route::delete('master-data/skema/{id}/destroy', [
            \App\Http\Controllers\SkemaController::class,
            'destroy',
        ])->name('skema.destroy');
        //end master-data skema route

        //master data jenis-output route
        Route::get('master-data/jenis-output', [
            JenisOutputController::class,
            'index',
        ])->name('jenis-output.index');
        Route::post('master-data/jenis-output/store', [
            \App\Http\Controllers\JenisOutputController::class,
            'store',
        ])->name('jenis-output.store');
        Route::put('master-data/jenis-output/{id}/update', [
            \App\Http\Controllers\JenisOutputController::class,
            'update',
        ])->name('jenis-output.update');
        Route::delete('master-data/jenis-output/{id}/destroy', [
            \App\Http\Controllers\JenisOutputController::class,
            'destroy',
        ])->name('jenis-output.destroy');
        //end master data jenis-output route

        //master data jenis-output key route
        Route::post('master-data/jenis-output-key/store', [
            JenisOutputKeyController::class,
            'store',
        ])->name('jenis-output-key.store');
        Route::put('master-data/jenis-output-key/{id}/update', [
            \App\Http\Controllers\JenisOutputKeyController::class,
            'update',
        ])->name('jenis-output-key.update');
        Route::delete('master-data/jenis-output-key/{id}/destroy', [
            \App\Http\Controllers\JenisOutputKeyController::class,
            'destroy',
        ])->name('jenis-output-key.destroy');
        //end master data jenis-output key route

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
    //arsip
    Route::get('penelitian/arsip', [
        \App\Http\Controllers\PenelitianController::class,
        'index',
    ])->name('penelitian.arsip');
    //end
    Route::post('penelitian/store', [
        \App\Http\Controllers\PenelitianController::class,
        'store',
    ])->name('penelitian.store');
    Route::get('penelitian/{uuid}', [
        \App\Http\Controllers\PenelitianController::class,
        'show',
    ])
        ->name('penelitian.show')
        ->middleware(EnsureAuthorPenelitian::class);
    Route::put('penelitian/{uuid}/update', [
        \App\Http\Controllers\PenelitianController::class,
        'update',
    ])->name('penelitian.update');
    Route::patch('penelitian/{uuid}/update-status-penelitian', [
        \App\Http\Controllers\PenelitianController::class,
        'updateStatusPenelitian',
    ])->name('penelitian.update-status-penelitian');
    Route::patch('penelitian/{uuid}/update-feedback', [
        \App\Http\Controllers\PenelitianController::class,
        'updateFeedback',
    ])->name('penelitian.update-feedback');
    Route::delete('penelitian/{uuid}/destroy', [
        \App\Http\Controllers\PenelitianController::class,
        'destroy',
    ])->name('penelitian.destroy');
    //end penelitian route
});
