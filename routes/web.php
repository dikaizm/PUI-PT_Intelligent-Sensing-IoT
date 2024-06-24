<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisOutputController;
use App\Http\Middleware\EnsureAuthorPenelitian;
use App\Http\Controllers\JenisOutputKeyController;
use Illuminate\Support\Facades\Auth;

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

    Route::get('/api/users', [
        \App\Http\Controllers\UserController::class,
        'apiIndex',
    ])->name('api.users.index');

    Route::get('users', [
        \App\Http\Controllers\UserController::class,
        'index',
    ])->name('users.index');

    Route::post('user/external-store', [
        \App\Http\Controllers\UserController::class,
        'externalStore',
    ])->name('user.external-store');

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

    Route::post('/laporan-kinerja', [
        \App\Http\Controllers\LaporanKinerjaController::class,
        'store',
    ])->name('laporan-kinerja.store');

    Route::get('/get-target-penelitian', [
        \App\Http\Controllers\TargetPenelitianController::class,
        'getTargetPenelitian']);


    Route::middleware('can:mengelola-pengguna')->group(function () {
        Route::get('master-data/register-key', [
            \App\Http\Controllers\RegisterKeyController::class,
            'index',
        ])->name('register-key.index');

        Route::get('master-data/register-key/{id}', [
            \App\Http\Controllers\RegisterKeyController::class,
            'newKey',
        ])->name('register-key.new-key');

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

        //master-data jenis penelitian
        Route::get('master-data/jenis-penelitian', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'index',
        ])->name('jenis-penelitian.index');
        Route::post('master-data/jenis-penelitian/store', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'store',
        ])->name('jenis-penelitian.store');
        Route::put('master-data/jenis-penelitian/{id}/update', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'update',
        ])->name('jenis-penelitian.update');
        Route::delete('master-data/jenis-penelitian/{id}/destroy', [
            \App\Http\Controllers\JenisPenelitianController::class,
            'destroy',
        ])->name('jenis-penelitian.destroy');
        //end master-data jenis penelitian route

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

        //master-data status jurnal route
        Route::get('master-data/status-output', [
            \App\Http\Controllers\StatusOutputController::class,
            'index',
        ])->name('status-output.index');
        Route::post('master-data/status-output/store', [
            \App\Http\Controllers\StatusOutputController::class,
            'store',
        ])->name('status-output.store');
        Route::put('master-data/status-output/{id}/update', [
            \App\Http\Controllers\StatusOutputController::class,
            'update',
        ])->name('status-output.update');
        Route::delete('master-data/status-output/{id}/destroy', [
            \App\Http\Controllers\StatusOutputController::class,
            'destroy',
        ])->name('status-output.destroy');
        //end master-data status output route

        //master-data status penelitian route
        Route::get('master-data/status-penelitian', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'index',
        ])->name('status-penelitian.index');
        Route::post('master-data/status-penelitian/store', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'store',
        ])->name('status-penelitian.store');
        Route::put('master-data/status-penelitian/{id}/update', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'update',
        ])->name('status-penelitian.update');
        Route::delete('master-data/status-penelitian/{id}/destroy', [
            \App\Http\Controllers\StatusPenelitianController::class,
            'destroy',
        ])->name('status-penelitian.destroy');
        //end master-data status penelitian route

        //master-data status penelitian key route
        Route::post('master-data/status-penelitian-key/store', [
            \App\Http\Controllers\StatusPenelitianKeyController::class,
            'store',
        ])->name('status-penelitian-key.store');
        Route::put('master-data/status-penelitian-key/{id}/update', [
            \App\Http\Controllers\StatusPenelitianKeyController::class,
            'update',
        ])->name('status-penelitian-key.update');
        Route::delete('master-data/status-penelitian-key/{id}/destroy', [
            \App\Http\Controllers\StatusPenelitianKeyController::class,
            'destroy',
        ])->name('status-penelitian-key.destroy');
        //end master-data status penelitian key route
    });
    //end mengelola-master-data middleware

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

    Route::get('penelitian/create', [
        \App\Http\Controllers\PenelitianController::class,
        'create',
    ])->name('penelitian.create');

    Route::post('penelitian/store', [
        \App\Http\Controllers\PenelitianController::class,
        'store',
    ])->name('penelitian.store');

    Route::middleware([EnsureAuthorPenelitian::class])->group(function () {
        Route::get('penelitian/{uuid}', [
            \App\Http\Controllers\PenelitianController::class,
            'show',
        ])->name('penelitian.show');

        Route::get('penelitian/{uuid}/edit', [
            \App\Http\Controllers\PenelitianController::class,
            'edit',
        ])->name('penelitian.edit');
    });

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

    //laporan output routes
    Route::get('laporan-output', [
        \App\Http\Controllers\OutputController::class,
        'index',
    ])->name('laporan-output.index');

    Route::get('output-detail/create', [
        \App\Http\Controllers\OutputDetailController::class,
        'create',
    ])->name('output-detail.create');

    Route::get('output-detail/{uuid}/create/{judul}', [
        \App\Http\Controllers\OutputDetailController::class,
        'createFromPenelitian',
    ])->name('output-detail.create-from-penelitian');

    //output store
    Route::post('output-detail/store-publikasi', [
        \App\Http\Controllers\OutputDetailController::class,
        'storePublikasi',
    ])->name('output-detail.store-publikasi');

    Route::post('output-detail/store-hki', [
        \App\Http\Controllers\OutputDetailController::class,
        'storeHKI',
    ])->name('output-detail.store-hki');

    Route::post('output-detail/store-foto-poster', [
        \App\Http\Controllers\OutputDetailController::class,
        'storeFotoPoster',
    ])->name('output-detail.store-foto-poster');

    Route::post('output-detail/store-video', [
        \App\Http\Controllers\OutputDetailController::class,
        'storeVideo',
    ])->name('output-detail.store-video');
    //end output store

    //output update
    Route::put('output-detail/{id}/update-publikasi', [
        \App\Http\Controllers\OutputDetailController::class,
        'updatePublikasi',
    ])->name('output-detail.update-publikasi');
    Route::put('output-detail/{id}/update-hki', [
        \App\Http\Controllers\OutputDetailController::class,
        'updateHKI',
    ])->name('output-detail.update-hki');
    Route::put('output-detail/{id}/update-foto-poster', [
        \App\Http\Controllers\OutputDetailController::class,
        'updateFotoPoster',
    ])->name('output-detail.update-foto-poster');
    Route::put('output-detail/{id}/update-video', [
        \App\Http\Controllers\OutputDetailController::class,
        'updateVideo',
    ])->name('output-detail.update-video');
    //end output update

    //output delete
    Route::delete('output-detail/{id}/destroy', [
        \App\Http\Controllers\OutputDetailController::class,
        'destroy',
    ])->name('output-detail.destroy');
    //end output delete

    // output archive
    Route::put('output-detail/{id}/archive', [
        \App\Http\Controllers\OutputDetailController::class,
        'archive',
    ])->name('output-detail.archive');

    //end laporan output routes
});
