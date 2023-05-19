<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\UserPremiumController;
use App\Http\Controllers\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Member\Moviecontroller as MemberMovieController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\TransactionController as MemberTransactionController;

Route::get('/', [MemberDashboardController::class, 'index'])->name('member.dashboard');

Route::get('movie/{id}', [MemberMovieController::class, 'show'])->name('member.movie.detail');
Route::get('movie/{id}/watch', [MemberMovieController::class, 'watch'])->name('member.movie.watch');

Route::post('transaction', [MemberTransactionController::class, 'store'])->name('member.transaction.store');

Route::view('view-subscription', 'member.subscription')->name('member.subscription');

Route::get('subscription', [UserPremiumController::class, 'index'])->name('member.user_premium.index');

Route::delete('subscription/{id}', [UserPremiumController::class, 'destroy'])->name('member.user_premium.destroy');

Route::get('logout', [MemberLoginController::class, 'logout'])->name('member.logout');