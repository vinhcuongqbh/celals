<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\UserReferralController;
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
    return view('front-end.home', ['centers' => (new CenterController)->centerQuery()]);
})->name('home');

Route::get('/gioi-thieu', function () {
    return view('front-end.gioi-thieu');
});

Route::get('/diem-khac-biet', function () {
    return view('front-end.diem-khac-biet');
});

Route::get('/khoa-hoc', function () {
    return view('front-end.khoa-hoc');
});

Route::get('/dang-ky-hoc-thu', function () {
    return view('front-end.dang-ky-hoc-thu', ['centers' => (new CenterController)->centerQuery()]);
});

Route::get('/co-so-dao-tao', function () {
    return view('front-end.gioi-thieu');
});

Route::get('/du-hoc', function () {
    return view('front-end.du-hoc');
});

Route::get('/tin-tuc', function () {
    return view('front-end.tin-tuc');
});


Route::get('/login', function () {
    return redirect()->route('login');
});

Route::get('/referral={id}', [UserReferralController::class, 'setReferral'])->name('referral.setReferral');
Route::post('/referral/register', [UserReferralController::class, 'register'])->name('referral.register');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'user'], function () {
        Route::get('', [UserController::class, 'index'])->name('user');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('{id}/', [UserController::class, 'show'])->name('user.show');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::get('{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('{id}/restore', [UserController::class, 'restore'])->name('user.restore');
        Route::post('{id}/resetpass', [UserController::class, 'resetpass'])->name('user.resetpass');
        Route::post('search', [UserController::class, 'search'])->name('user.search');
    });

    Route::group(['prefix' => 'referral'], function () {
        Route::get('/customer', [UserReferralController::class, 'customer'])->name('referral.customer');
        Route::get('/customer/{id}', [UserReferralController::class, 'show'])->name('referral.show');
        Route::post('/customer/update/{id}', [UserReferralController::class, 'update'])->name('referral.update');
        Route::get('/referrer', [UserReferralController::class, 'referrer'])->name('referral.referrer');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
