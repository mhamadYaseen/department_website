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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('role:Admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resources([
        'subjects' => SubjectController::class,
        'lectures' => LecturesController::class,
        'exam-papers' => ExamPaperController::class
    ]);
});

// Student & Public Routes
Route::middleware('auth')->group(function () {
    // Downloads
    Route::get('/exam-papers/{id}/download', [ExamPaperController::class, 'download'])->name('exam-papers.download');
    Route::get('/lectures/{id}/download', [LecturesController::class, 'download'])->name('lectures.download');

    // View Only Routes
    Route::resource('lectures', LecturesController::class)->only(['index', 'show']);
    Route::resource('subjects', SubjectController::class)->only(['index', 'show']);
    Route::resource('exam-papers', ExamPaperController::class)->only(['index', 'show']);
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::group(['middleware' => ['role:Student']], function () {
    Route::get('/student', function () {
        return view('student.dashboard');
    });
});

Route::post('/admin/assign-role', [AdminController::class, 'assignRole'])->name('admin.assignRole');

Route::get('/search', [SearchController::class, 'search'])->name('search');



Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (HttpRequest $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:3,1'])->name('verification.send');
});



use Illuminate\Support\Facades\Mail;

Route::get('/send-test-email', function () {
    Mail::raw('This is a test email from Laravel using Sendinblue.', function ($message) {
        $message->to(Auth::user()->email)
            ->subject('Test Email');
    });

    return 'Test email sent successfully!';
});
