<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('dashboard.admin.home');
            }
            return view('dashboard.user.home');
        }
    }

    public function dashboard(Request $request)
    {
        $query = $request->input('query');
        \Log::info('Search query: ' . $query);

        $jobs = JobPost::query()
            ->when($query, function ($q) use ($query) {
                return $q->where('title', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%")
                         ->orWhere('location', 'like', "%{$query}%")
                         ->orWhere('jobType', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('dashboard', ['jobs' => $jobs]);
    }
}
