<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppliedJobsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $appliedJobs = $user->appliedJobs()->withPivot('created_at', 'status')->get();

        return view('applied', compact('appliedJobs'));
    }
}