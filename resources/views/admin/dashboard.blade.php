@extends('layouts.app')

@section('content')
   <div class="container">
      <h1 class="text-center mb-4">Admin Dashboard</h1>

      <!-- Statistics Section -->
      <div class="row justify-content-center">
         <div class="col-md-3 mx-2">
            <div class="card">
               <div class="card-body text-center">
                  <h5>Total Users</h5>
                  <p>{{ $totalUsers }}</p>
               </div>
            </div>
         </div>
         <div class="col-md-3 mx-2">
            <div class="card">
               <div class="card-body text-center">
                  <h5>Total Subjects</h5>
                  <p>{{ $totalSubjects }}</p>
               </div>
            </div>
         </div>
      </div>

      <!-- User Management -->
      <h2 class="text-center mt-4">Manage Users</h2>
      <div class="table-responsive">
         <table class="table table-bordered mx-auto" style="max-width: 800px;">
            <thead>
               <tr>
                  <th class="px-4">Name</th>
                  <th class="px-4">Email</th>
                  <th class="px-4">Role</th>
               </tr>
            </thead>
            <tbody>
               @foreach($users as $user)
                  <tr>
                     <td class="px-4">{{ $user->name }}</td>
                     <td class="px-4">{{ $user->email }}</td>
                     <td class="px-4">{{ $user->roles->pluck('name')->join(', ') }}</td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      
      <div class="row justify-content-center mt-4">
         <div class="col-md-6">
            <div class="card">
               <div class="card-body">
                  <h5 class="text-center">Assign Roles</h5>
                  <form action="{{ route('admin.assignRole') }}" method="POST">
                     @csrf
                     <div class="form-group">
                        <label for="user">Select User</label>
                        <select name="user_id" id="user" class="form-control">
                           <option value="">Select User</option>
                           @foreach($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}: ({{ $user->email }})</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="role">Select Role</label>
                        <select name="role" id="role" class="form-control">
                           @foreach($roles as $role)
                              <option value="{{ $role->name }}">{{ $role->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">Assign Role</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
