<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobPost;
use App\Models\Application;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalJobPosts = JobPost::count();
        $totalApplications = Application::count();

        return view('admin.dashboard', compact('totalUsers', 'totalJobPosts', 'totalApplications'));
    }

    public function showAddUserForm()
    {
        return view('admin.add-user');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,employer,job_seeker',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User added successfully.');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully.');
    }

    public function manageJobs()
    {
        $jobs = JobPost::all();
        return view('admin.manage-jobs', compact('jobs'));
    }
}
