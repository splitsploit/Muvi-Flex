<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Member\PricingController;
use App\Http\Controllers\Member\WebHookController;
use App\Http\Controllers\Member\RegisterController;
use App\Http\Controllers\Member\UserPremiumController;
use App\Http\Controllers\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Member\Moviecontroller as MemberMovieController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\TransactionController as MemberTransactionController;

use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\DashboardController;

Route::view('/', 'index');

Route::get('register', [RegisterController::class, 'index'])->name('member.register');
Route::post('register', [RegisterController::class, 'store'])->name('member.register.post');

Route::get('login', [MemberLoginController::class, 'index'])->name('member.login');
Route::post('login', [MemberLoginController::class, 'login'])->name('member.login.post');

Route::get('pricing', [PricingController::class, 'index'])->name('member.pricing');

Route::post('/payment-notification', [WebHookController::class, 'handler'])->withoutMiddleware(VerifyCsrfToken::class);

Route::view('payment-final', 'member.payment-final')->name('member.payment-final');

Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'authenticate'])->name('admin.login.auth');
