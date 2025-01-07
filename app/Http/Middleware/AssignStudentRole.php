<?php

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AssignStudentRole
{
    public function handle(Request $request, Closure $next)
    {
        dd("hello");
        if (!Auth::check()) {
            // Temporarily assign student permissions to non-authenticated users
            $studentRole = Role::where('name', 'Student')->first();
            if ($studentRole) {
                // Attach permissions from student role to the request
                $request->merge(['student_permissions' => $studentRole->permissions]);
            }
        }

        return $next($request);
    }
}
