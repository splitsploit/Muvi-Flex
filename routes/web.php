<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\LoginController;
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
    return view('welcome');
});

// ! test route
// Route::get('test', function() {
//     return view('admin.dashboard');
// });

Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'authenticate'])->name('admin.login.auth');

// !! Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function() {
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
});
