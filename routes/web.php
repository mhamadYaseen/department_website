<?php

use App\Http\Controllers\{

    HomeController,
    LecturesController,
    SubjectController,
    ExamPaperController,
    FeedbackController,
    SearchController
};
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Controllers\AccountController;
Auth::routes();

Route::delete('/account/delete', [AccountController::class, 'destroy'])->name('account.delete')->middleware('auth');
Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit')->middleware('auth');
Route::put('/account/update', [AccountController::class, 'update'])->name('account.update')->middleware('auth');


Route::get('/', [HomeController::class, 'index'])->name('home');


// Admin Routes
Route::middleware('role:Admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/assign-role', [AdminController::class, 'assignRole'])->name('admin.assignRole');
    Route::resource('subjects', SubjectController::class)->except(['index', 'show']);
    Route::resource('lectures', LecturesController::class)->except(['index', 'show']);
    Route::resource('exam-papers', ExamPaperController::class)->except(['index', 'show']);
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});



// public Routes
Route::resource('lectures', LecturesController::class)->only(['index', 'show']);
Route::resource('subjects', SubjectController::class)->only(['index', 'show']);
Route::resource('exam-papers', ExamPaperController::class)->only(['index', 'show']);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/exam-papers/{paper}/download', [ExamPaperController::class, 'download'])->name('exam-papers.download');
Route::post('/send-feedback', [FeedbackController::class, 'sendFeedback'])->name('send.feedback');
Route::get('/lectures/{lecture}/force-download', [LecturesController::class, 'forceDownload'])->name('lectures.forceDownload');
