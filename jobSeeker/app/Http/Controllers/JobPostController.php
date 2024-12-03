<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobPostController extends Controller
{
    public function index()
    {
        $jobPosts = JobPost::latest()->paginate(6);
        return view('job_posts.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('job_posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'jobType' => 'required|in:full-time,part-time,freelance',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|min:0|gte:salary_min',
        ]);

        $jobPost = new JobPost([
            'title' => $request->title,
            'location' => $request->location,
            'jobType' => $request->jobType,
            'contact' => $request->contact,
            'description' => $request->description,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'user_id' => Auth::id(),
        ]);

        $jobPost->save();

        return redirect()->route('job-posts.index')->with('success', 'Job post created successfully.');
    }

    public function show(JobPost $jobPost)
    {
        return view('job_posts.show', compact('jobPost'));
    }

    public function edit(JobPost $jobPost)
    {
        return view('job_posts.edit', compact('jobPost'));
    }

    public function update(Request $request, JobPost $jobPost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'jobType' => 'required|in:full-time,part-time,freelance',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|min:0|gte:salary_min',
        ]);

        $jobPost->update($request->all());

        return redirect()->route('job-posts.index')->with('success', 'Job post updated successfully.');
    }

    public function destroy(JobPost $jobPost)
    {
        $jobPost->delete();

        return redirect()->route('job-posts.index')->with('success', 'Job post deleted successfully.');
    }

    public function myJobs()
    {
        $jobPosts = JobPost::where('user_id', Auth::id())
                          ->latest()
                          ->paginate(6);
        return view('myJobs', compact('jobPosts'));
    }

    public function showApplicants(JobPost $jobPost)
    {
        // Ensure the authenticated user is the owner of the job post
        if (Auth::id() !== $jobPost->user_id) {
            return redirect()->route('job-posts.myJobs')->with('error', 'Unauthorized access.');
        }

        $applicants = $jobPost->applicants()->withPivot('created_at', 'status')->get();

        return view('job_posts.showApplicants', compact('jobPost', 'applicants'));
    }
}