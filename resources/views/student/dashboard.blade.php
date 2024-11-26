{{-- import lecture model --}}
@php
use App\Models\Subject;
use App\Models\ExamPaper;

@endphp
@extends('layouts.app')

@section('content')
<div class="container py-4">
   <!-- Welcome Section -->
   <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
      <h1 class="text-2xl font-bold text-gray-800">Welcome to Student Dashboard</h1>
      <p class="text-gray-600">Access all your academic resources in one place</p>
   </div>

   <!-- Quick Stats -->
   <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-blue-50 p-4 rounded-lg shadow-sm">
         <h3 class="font-bold text-blue-700">My Subjects</h3>
         <p class="text-2xl text-blue-800">{{Subject::all()->count()}}</p>
      </div>
      <div class="bg-green-50 p-4 rounded-lg shadow-sm">
         <h3 class="font-bold text-green-700">Exam paers</h3>
         <p class="text-2xl text-green-800">{{ExamPaper::all()->count()}}</p>
      </div>
      
   </div>

   <!-- Main Navigation Cards -->
   <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Lectures Card -->
      <a href="{{ route('lectures.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
         <div class="flex items-center mb-4">
            <i class="fas fa-chalkboard-teacher text-2xl text-blue-600 mr-3"></i>
            <h2 class="text-xl font-semibold text-gray-800">Lectures</h2>
         </div>
         
      </a>

      <!-- Subjects Card -->
      <a href="{{ route('subjects.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
         <div class="flex items-center mb-4">
            <i class="fas fa-book text-2xl text-green-600 mr-3"></i>
            <h2 class="text-xl font-semibold text-gray-800">Subjects</h2>
         </div>
        
      </a>

      <!-- Exam Papers Card -->
      <a href="{{ route('exam-papers.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition duration-300">
         <div class="flex items-center mb-4">
            <i class="fas fa-file-alt text-2xl text-purple-600 mr-3"></i>
            <h2 class="text-xl font-semibold text-gray-800">Exam Papers</h2>
         </div>
         
      </a>
   </div>

</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush
@endsection