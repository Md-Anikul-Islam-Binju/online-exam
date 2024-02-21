<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ExamController;
use App\Http\Controllers\admin\ExamQueController;
use App\Http\Controllers\admin\UserListController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\user\UserExamController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AdminUserController::class, 'home'])->name('home');


// Routes accessible only to authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminUserController::class, 'dashboard'])->name('dashboard');

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    //exam
    Route::get('/exam', [ExamController::class, 'index'])->name('exam');
    Route::post('/exam/store', [ExamController::class, 'store'])->name('exam.store');
    Route::put('/exam/update/{id}', [ExamController::class, 'update'])->name('exam.update');
    Route::get('/exam/delete/{id}', [ExamController::class, 'destroy'])->name('exam.delete');

    //exam
    Route::get('/exam-question/add/{id}', [ExamQueController::class, 'index'])->name('exam.que.add');
    Route::post('/exam-question/store', [ExamQueController::class, 'store'])->name('exam.que.store');
    Route::put('/exam-question/update/{id}', [ExamQueController::class, 'update'])->name('exam.que.update');
    Route::delete('/exam-question/delete/{id}', [ExamQueController::class, 'destroy'])->name('exam.que.delete');

    //user-list
    Route::get('/user-list', [UserListController::class, 'userList'])->name('user.list');
    Route::get('/user/delete/{id}', [UserListController::class, 'destroy'])->name('user.delete');

    //user-exam-result-list
    Route::get('/user-exam-result-list', [UserListController::class, 'userExamResultList'])->name('user.exam.result.list');
    Route::get('/user-exam-result-delete/{id}', [UserListController::class, 'userExamResultDestroy'])->name('user.exam.result.delete');


    //apply-exam
    Route::get('/apply-exam/{id}', [AdminUserController::class, 'applyExam'])->name('apply.exam');
    //start-exam
    Route::get('/start-exam', [UserExamController::class, 'startExam'])->name('start.exam');
    //start-exam-with-question
    Route::get('/start-exam-with-question/{exam_id}',[UserExamController::class,'startExamWithQuestion'])->name('start.exam.with.question');
    //submit-exam
    Route::post('/submit-exam',[UserExamController::class,'submitExam'])->name('submit.exam');
    //exam-result
    Route::get('/exam-result/{exam_id}',[UserExamController::class,'examResult'])->name('exam.result');

});


require __DIR__.'/auth.php';
