@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-3">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Edit Account</div>

            <div class="card-body">
               @if (session('status'))
                  <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                  </div>
               @endif

               <form method="POST" action="{{ route('account.update') }}">
                  @csrf
                  @method('PUT')

                  <div class="form-group mb-3">
                     <label for="name">Name</label>
                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                        name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name">
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="email">Email Address</label>
                     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                        name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="password">New Password (leave blank to keep current password)</label>
                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                        name="password" autocomplete="new-password">
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group mb-3">
                     <label for="password-confirm">Confirm New Password</label>
                     <input id="password-confirm" type="password" class="form-control" 
                        name="password_confirmation" autocomplete="new-password">
                  </div>

                  <div class="form-group mb-0">
                     <button type="submit" class="btn btn-primary">
                        Update Account
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection