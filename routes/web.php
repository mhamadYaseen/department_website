<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ExamPaperController;
use App\Http\Controllers\LecturesController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request as HttpRequest;
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('lectures', LecturesController  ::class);
Route::resource('subjects', SubjectController::class);
Route::resource('exam-papers', ExamPaperController::class);


// adding donload funcitonality 
Route::get('/exam-papers/download/{id}', [ExamPaperController::class, 'download'])->name('exam-papers.download');
Route::get('/lectures/download/{id}', [LecturesController::class, 'download'])->name('lectures.download');

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
