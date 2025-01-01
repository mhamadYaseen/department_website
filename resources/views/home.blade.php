@extends('layouts.app')

@section('content')
    <div class="text-center position-relative px-0 mb-1">
        <img src="{{ asset('storage/images/laptop.webp') }}" alt="welcome image" class="img-fluid  shadow w-100"
            style="height: auto;">

        <h2 class="img-text-css position-absolute start-50 translate-middle-x text-white fw-bold">
            Welcome to the Lectures Website
        </h2>
    </div>

    <div class="w-75 mx-auto my-3 opacity-75"
        style="height: 5px; background-image: linear-gradient(to right, #f9ff43, #ff0000);">
    </div>

    <div class="container-fluid container-md">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Dashboard Card -->
                @include('layouts.message')
                <div class="card mb-4">
                    <!-- Latest Lectures Card -->
                    @include('shared.latest-lectures-card')
                </div>
            </div>
        </div>
    </div>
@endsection
