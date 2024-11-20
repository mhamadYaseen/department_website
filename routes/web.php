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
