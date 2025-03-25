@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="text-center position-relative px-0 mb-1 " style="margin-top:-60px; z-index:-1;">
        <div class="bg-black h-10 mt-5 pt-5"></div>
        <img src="{{ asset('storage/images/laptop.webp') }}" alt="welcome image" class="img-fluid  shadow w-100"
            style="height: auto;">

        <h2 class="img-text-css position-absolute start-50 translate-middle-x text-white fw-bold"
            style=" user-select: none; pointer-events: none;">
            Welcome to the software department Website
        </h2>
    </div>

    <div class="container-fluid container-md">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Latest Lectures Card -->
                @include('shared.latest-lectures-card')

                <!-- latest exam-papers-card -->
                @include('shared.latest-exampapers-card')
            </div>
        </div>
    </div>
@endsection
