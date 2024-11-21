<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ExamPaperController;
use App\Http\Controllers\LecturesController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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
