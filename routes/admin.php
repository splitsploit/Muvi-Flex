<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\NotificationController;

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    // ** Movie Routes
    Route::group(['prefix' => 'movie'], function() {
        Route::get('/', [MovieController::class, 'index'])->name('movie.index');

        Route::get('create', [MovieController::class, 'create'])->name('movie.create');
        Route::post('store', [MovieController::class, 'store'])->name('movie.store');

        Route::get('edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
        Route::put('update/{id}', [MovieController::class, 'update'])->name('movie.update');

        Route::delete('delete/{id}', [MovieController::class, 'destroy'])->name('movie.delete');
    });

    // ** Traansaction Routes
    Route::group(['prefix' => 'transaction'], function() {
        Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    });

    // ** Notification Routes
    Route::get('notification', [NotificationController::class, 'index'])->name('admin.notification');