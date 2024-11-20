@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Lectures</h1>
      <ul>
         @foreach($lectures as $lecture)
            <li>
               {{ $lecture->title }} - 
               <a href="{{ asset('storage/' . $lecture->file_path) }}" target="_blank">View PDF</a>
            </li>
         @endforeach
      </ul>
   </div>
@endsection