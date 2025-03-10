<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CoachQuestionController;
use App\Http\Controllers\CoachStudentController;
use App\Http\Controllers\CoachSubjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserReferralController;
use App\Http\Controllers\SukienController;
use App\Http\Controllers\TintucController;
use App\Http\Controllers\GioiThieuController;
use App\Http\Controllers\ListeningBlockController;
use App\Http\Controllers\ListeningLessonController;
use App\Http\Controllers\ListeningTestController;
use App\Http\Controllers\PracticeTestController;
use App\Http\Controllers\PracticeTestPublicController;
use App\Http\Controllers\StudentListeningBlockController;
use App\Http\Controllers\StudentListeningTestController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VocabularyTestController;
use App\Models\Center;
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
    $centers = Center::all();
    return view('front-end.dang-ky', ['centers' => $centers]);
})->name('dang-ky');

Route::get('/co-so-dao-tao', function () {
    return view('front-end.co-so-dao-tao');
});

Route::get('/du-hoc', function () {
    return view('front-end.du-hoc');
});

Route::prefix('post_catalogue')->group(function () {
    Route::get('/{post_catalogue}', [PostController::class, 'postCatalogue'])->name('post_catalogue');    
    Route::get('/{post_catalogue}/{id}', [PostController::class, 'postDetail'])->name('post_detail');
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

Route::prefix('test')->group(function () {
    Route::get('{id}/testing', [VocabularyTestController::class, 'testing'])->name('test.testing');
    Route::post('/testing/store', [VocabularyTestController::class, 'testingStore'])->name('test.testing.store');
    Route::get('{id}/studing', [VocabularyTestController::class, 'studing'])->name('test.studing');
    Route::get('{id}/ranking', [VocabularyTestController::class, 'ranking'])->name('test.ranking');
    Route::get('{id}/testingShow', [VocabularyTestController::class, 'testingShow'])->name('test.result.show');
});

Route::get('public_test/{test_id}/testing', [PracticeTestPublicController::class, 'testing'])->name('public_test.testing');
Route::post('public_test/{test_id}/store', [PracticeTestPublicController::class, 'store'])->name('public_test.store');


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

    Route::group(['prefix' => 'topic'], function () {
        Route::post('topicList', [TopicController::class, 'topicList'])->name('topic.topicList');
    });

    Route::group(['prefix' => 'block'], function () {
        Route::post('blockList', [BlockController::class, 'blockList'])->name('block.blockList');
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

    Route::group(['prefix' => 'class'], function () {
        Route::group(['prefix' => 'vocabulary'], function () {
            Route::get('test_create', [VocabularyTestController::class, 'testCreate'])->name('vocabulary.test_create');
            Route::get('test_list', [VocabularyTestController::class, 'testList'])->name('vocabulary.test_list');
            Route::post('test_search', [VocabularyTestController::class, 'testSearch'])->name('vocabulary.test_search');
            Route::post('test_store', [VocabularyTestController::class, 'testStore'])->name('vocabulary.test_store');
            Route::get('{id}/', [VocabularyTestController::class, 'testShow'])->name('vocabulary.test_show');
        });

        Route::group(['prefix' => 'listening'], function () {
            Route::get('lesson_create', [ListeningLessonController::class, 'lessonCreate'])->name('listening.lesson_create');
            Route::post('lesson_store', [ListeningLessonController::class, 'lessonStore'])->name('listening.lesson_store');
            Route::get('{id}/lesson_edit', [ListeningLessonController::class, 'lessonEdit'])->name('listening.lesson_edit');
            Route::post('{id}/lesson_update', [ListeningLessonController::class, 'lessonUpdate'])->name('listening.lesson_update');
            Route::get('{id}/lesson_show', [ListeningLessonController::class, 'lessonShow'])->name('listening.lesson_show');
            Route::get('lesson_list', [ListeningLessonController::class, 'lessonList'])->name('listening.lesson_list');

            Route::get('test_create', [ListeningTestController::class, 'testCreate'])->name('listening.test_create');
            Route::post('test_store', [ListeningTestController::class, 'testStore'])->name('listening.test_store');
            Route::get('{id}/test_edit', [ListeningTestController::class, 'testEdit'])->name('listening.test_edit');
            Route::post('{id}/test_update', [ListeningTestController::class, 'testUpdate'])->name('listening.test_update');
            Route::get('{id}/test_show', [ListeningTestController::class, 'testShow'])->name('listening.test_show');
            Route::get('test_list', [ListeningTestController::class, 'testList'])->name('listening.test_list');

            Route::get('block_create', [ListeningBlockController::class, 'blockCreate'])->name('listening.block_create');
            Route::post('block_store', [ListeningBlockController::class, 'blockStore'])->name('listening.block_store');
            Route::get('{id}/block_edit', [ListeningBlockController::class, 'blockEdit'])->name('listening.block_edit');
            Route::post('{id}/block_update', [ListeningBlockController::class, 'blockUpdate'])->name('listening.block_update');
            Route::get('{id}/block_show', [ListeningBlockController::class, 'blockShow'])->name('listening.block_show');
            Route::get('block_list', [ListeningBlockController::class, 'blockList'])->name('listening.block_list');

            Route::get('teacher_test_list', [ListeningBlockController::class, 'teacherTestList'])->name('listening.teacher_test_list');
            Route::get('{id}/teacher_test_edit', [ListeningBlockController::class, 'teacherTestEdit'])->name('listening.teacher_test_edit');
            Route::post('{id}/teacher_test_update', [ListeningBlockController::class, 'teacherTestUpdate'])->name('listening.teacher_test_update');
            Route::get('student_list', [ListeningBlockController::class, 'studentList'])->name('listening.student_list');
            Route::get('student_list/{i}', [ListeningBlockController::class, 'editStudentBlock'])->name('listening.edit_student_block');
            Route::post('student_list/{i}', [ListeningBlockController::class, 'updateStudentBlock'])->name('listening.update_student_block');
            Route::get('{id}/next_block', [ListeningBlockController::class, 'nextBlock'])->name('listening.next_block');

            Route::get('student_block_show', [StudentListeningBlockController::class, 'blockShow'])->name('listening.student_block_show');
            Route::get('student_history_study', [StudentListeningTestController::class, 'historyList'])->name('listening.student_history_study');
            Route::get('{id}/student_history_show', [StudentListeningTestController::class, 'historyShow'])->name('listening.student_history_show');
            Route::get('{id}/student_lesson_show', [StudentListeningBlockController::class, 'lessonShow'])->name('listening.student_lesson_show');
            Route::get('{id}/student_test_create', [StudentListeningTestController::class, 'testCreate'])->name('listening.student_test_create');
            Route::post('student_test_store', [StudentListeningTestController::class, 'testStore'])->name('listening.student_test_store');
        });


        Route::group(['prefix' => 'coaching'], function () {
            Route::resource('coach_subject', CoachSubjectController::class);
            Route::resource('coach_question', CoachQuestionController::class);
            Route::get('summary', [CoachStudentController::class, 'summary']);
            Route::post('summary', [CoachStudentController::class, 'summary'])->name('coaching.coach_student.summary');
            Route::get('coach_student/{coach_type_id}', [CoachStudentController::class, 'coach_student']);
            Route::post('coach_student/{coach_type_id}', [CoachStudentController::class, 'coach_student'])->name('coaching.coach_student');
            Route::post('assignment', [CoachStudentController::class, 'assignment'])->name('coaching.assignment');
            Route::get('get_coach_question', [CoachStudentController::class, 'get_coach_question'])->name('coaching.get_coach_question');
            Route::post('{user_id}/{coach_type_id}/student_result_update', [CoachStudentController::class, 'student_result_update'])->name('coaching.student_result.update');
        });

        Route::resource('practice_test', PracticeTestController::class);
        Route::get('practice_test/{test_id}/public', [PracticeTestController::class, 'public'])->name('practice_test.public');
        Route::get('practice_test/public_test/{test_id}', [PracticeTestPublicController::class, 'index'])->name('practice_test.public_text.index');
        Route::get('public_test', [PracticeTestPublicController::class, 'index'])->name('public_text');
        Route::get('public_test/{public_test_id}/', [PracticeTestPublicController::class, 'show'])->name('public_text.show');
        Route::get('public_test/{public_test_id}/{student_id}/edit', [PracticeTestPublicController::class, 'edit'])->name('public_test.edit');
        Route::post('public_test/{public_test_id}/{student_id}/update', [PracticeTestPublicController::class, 'update'])->name('public_test.teacher_test.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
