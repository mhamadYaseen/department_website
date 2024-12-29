@extends('layouts.app')

@section('content')
    <div class="container">
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
