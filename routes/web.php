<?php

use App\Http\Controllers\{

    HomeController,
    LecturesController,
    SubjectController,
    ExamPaperController,
    SearchController
};
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\{Route, Auth};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request as HttpRequest;

Auth::routes();

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


// Admin Routes
Route::middleware('role:Admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/assign-role', [AdminController::class, 'assignRole'])->name('admin.assignRole');
    Route::resource('subjects', SubjectController::class)->except(['index', 'show']);
    Route::resource('lectures', LecturesController::class)->except(['index', 'show']);
    Route::resource('exam-papers', ExamPaperController::class)->except(['index', 'show']);
    Route::get('/subjects/create', [SubjectController::class, 'create']);
});
// Student & Public Routes
Route::middleware('auth')->group(function () {
    // Downloads
    Route::get('/exam-papers/{id}/download', [ExamPaperController::class, 'download'])->name('exam-papers.download');
    Route::get('/lectures/{id}/download', [LecturesController::class, 'download'])->name('lectures.download');
});

// public Routes
Route::resource('lectures', LecturesController::class)->only(['index', 'show']);
Route::resource('subjects', SubjectController::class)->only(['index', 'show']);
Route::resource('exam-papers', ExamPaperController::class)->only(['index', 'show']);
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::group(['middleware' => ['role:Student']], function () {
    Route::get('/student', function () {
        return view('student.dashboard');
    });
});



use Illuminate\Support\Facades\Mail;

Route::get('/send-test-email', function () {
    Mail::raw('This is a test email from Laravel using Sendinblue.', function ($message) {
        $message->to(Auth::user()->email)
            ->subject('Test Email');
    });

    return 'Test email sent successfully!';
});
