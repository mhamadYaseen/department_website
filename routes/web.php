<?php

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

