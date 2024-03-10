<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserReferralController;
use App\Http\Controllers\SukienController;
use App\Http\Controllers\TintucController;
use App\Http\Controllers\GioiThieuController;
use App\Http\Controllers\TestController;
use App\Models\PostCatalogue;
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

Route::get('/diem-khac-biet', function () {
    return view('front-end.diem-khac-biet');
});

Route::get('/khoa-hoc', function () {
    return view('front-end.khoa-hoc');
});

Route::get('/dang-ky', function () {
    return view('front-end.dang-ky', ['centers' => (new CenterController)->centerQuery()]);
})->name('dang-ky');

Route::get('/co-so-dao-tao', function () {
    return view('front-end.co-so-dao-tao');
});

Route::get('/du-hoc', function () {
    return view('front-end.du-hoc');
});

Route::prefix('su-kien')->group(function () {
    Route::get('', [SukienController::class, 'suKien'])->name('su-kien');
    Route::get('/{id}', [SukienController::class, 'suKienChiTiet'])->name('su-kien-chi-tiet');
});

Route::prefix('tin-tuc')->group(function () {
    Route::get('', [TinTucController::class, 'tinTuc'])->name('tin-tuc');
    Route::get('/{id}', [TinTucController::class, 'tinTucChiTiet'])->name('tin-tuc-chi-tiet');
});

Route::prefix('gioi-thieu')->group(function () {
    Route::get('', [GioiThieuController::class, 'gioiThieu'])->name('gioi-thieu');
    
});

Route::get('/', function () {
    return view('front-end.home');
});


Route::get('/login', function () {
    return redirect()->route('login');
});

Route::get('/ref={id}', [UserReferralController::class, 'setReferral'])->name('referral.setReferral');
Route::get('{any}/ref={id}', [UserReferralController::class, 'setReferral2'])->where('any', '.*');

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

    Route::group(['prefix' => 'post'], function () {
        Route::get('', [PostController::class, 'index'])->name('post');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::post('search', [PostController::class, 'search'])->name('post.search');
        Route::get('{id}/', [PostController::class, 'show'])->name('post.show');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::post('{id}/update', [PostController::class, 'update'])->name('post.update');
        Route::get('{id}/public', [PostController::class, 'public'])->name('post.public');
        Route::get('{id}/unpublic', [PostController::class, 'unpublic'])->name('post.unpublic');
        Route::get('{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

    });

    Route::group(['prefix' => 'referral'], function () {
        Route::get('/customer', [UserReferralController::class, 'customer'])->name('referral.customer');
        Route::get('/customer/{id}', [UserReferralController::class, 'show'])->name('referral.show');
        Route::post('/customer/update/{id}', [UserReferralController::class, 'update'])->name('referral.update');
        Route::get('/referrer', [UserReferralController::class, 'referrer'])->name('referral.referrer');
    });


    Route::group(['prefix' => 'test'], function () {
        Route::get('create', [TestController::class, 'create'])->name('test.create');
        Route::post('search', [TestController::class, 'search'])->name('test.search');
        Route::post('store', [TestController::class, 'store'])->name('test.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
