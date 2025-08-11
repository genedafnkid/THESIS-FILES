<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all(); // admin, instructor, student
        return view('admin.users', compact('users', 'roles'));
    }

    // Assign a user's role
    public function approveUser($id, $roleName)
    {
        $user = User::findOrFail($id);
        $user->assignRole($roleName); // 'instructor' or 'student'
        return redirect()->back()->with('success', 'User role assigned successfully.');
    }
}
