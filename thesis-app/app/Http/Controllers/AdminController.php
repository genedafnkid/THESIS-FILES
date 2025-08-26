<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    // Pending tab
    public function index()
    {
        $users = User::with('roles')->where('status', 'pending')->get();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    // Approved tab
    public function approved()
    {
        $users = User::with('roles')->where('status', 'approved')->get();
        $roles = Role::all();
        return view('admin.users-approved', compact('users', 'roles'));
    }

    public function approveUser($id, $roleName)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->assignRole($roleName);
        $user->save();

        return back()->with('success', 'User approved successfully.');
    }

    public function denyUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'denied';
        $user->save();

        return back()->with('success', 'User denied.');
    }

    // Optional: move an approved user back to pending (and keep roles as-is)
    public function revokeUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'pending';
        $user->save();

        return back()->with('success', 'User moved back to pending.');
    }

    // Optional: change role of an already-approved user
    public function changeRole($id, $roleName)
    {
        $user = User::findOrFail($id);
        $user->syncRoles([$roleName]); // replace existing roles with the new one
        return back()->with('success', "Role changed to {$roleName}.");
    }
}
