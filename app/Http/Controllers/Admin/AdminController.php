<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamPaper;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = $users->count();

        $totalSubjects = Subject::count();
        $roles = Role::all();
        $tatalExams = ExamPaper::count();

        return view('admin.dashboard', compact('totalUsers', 'totalSubjects', 'users', 'roles', 'tatalExams'));
    }
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->syncRoles($request->role); // Replace any existing roles with the new one

        return redirect()->route('admin')->with('success', 'Role assigned successfully!');
    }
}
