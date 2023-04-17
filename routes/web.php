<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Member\PricingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\RegisterController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Member\LoginController as MemberLoginController;

Route::view('/', 'index');

// !! Member Route
Route::get('register', [RegisterController::class, 'index'])->name('member.register');
Route::post('register', [RegisterController::class, 'store'])->name('member.register.post');

Route::get('login', [MemberLoginController::class, 'index'])->name('member.login');
Route::post('login', [MemberLoginController::class, 'login'])->name('member.login.post');

Route::get('pricing', [PricingController::class, 'index'])->name('member.pricing');

Route::group(['prefix' => 'member', 'middleware' => 'auth'], function() {

    // Route::get('test', function() {
    //     if(! Auth::user()) {
    //         return redirect()->route('member.login');
    //     }
    //     return 'Anda Sudah Login';
    // });

    Route::get('/', [MemberDashboardController::class, 'index'])->name('member.dashboard');
});

// !! test route
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
