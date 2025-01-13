@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="font-weight-light my-2">{{ __('Register') }}</h3>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
                                   placeholder="Full Name">
                            <label for="name">{{ __('Full Name') }}</label>
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" 
                                   placeholder="name@example.com">
                            <label for="email">{{ __('Email Address') }}</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password" 
                                   placeholder="Password">
                            <label for="password">{{ __('Password') }}</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password" 
                                   placeholder="Confirm Password">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center py-3">
                    <div class="small">
                        <a href="{{ route('login') }}">{{ __('Already have an account? Login!') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
