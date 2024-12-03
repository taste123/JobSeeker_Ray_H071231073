<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function apply(Request $request, JobPost $jobPost)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to apply for a job.');
        }

        $request->validate([
            'cv' => 'required|file|mimes:pdf,docx|max:2048',
        ]);

        // Create directory if it doesn't exist
        Storage::makeDirectory('private/cvs');

        // Store CV in private storage
        $fileName = time() . '_' . $request->file('cv')->getClientOriginalName();
        $cvPath = $request->file('cv')->storeAs('private/cvs', $fileName);

        Application::create([
            'user_id' => Auth::id(),
            'job_post_id' => $jobPost->id,
            'cv' => $cvPath,
            'status' => 'on process',
        ]);

        return redirect()->route('job-posts.show', $jobPost)->with('success', 'Application submitted successfully.');
    }

    public function viewCV($jobPostId, $userId)
    {
        $application = Application::where('job_post_id', $jobPostId)
                                ->where('user_id', $userId)
                                ->firstOrFail();

        if (Auth::id() !== $application->jobPost->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Debug information to verify paths
        if (!Storage::exists($application->cv)) {
            dd([
                'cv_path_in_db' => $application->cv,
                'full_storage_path' => storage_path('app/' . $application->cv),
                'storage_base_path' => storage_path(),
                'file_exists' => Storage::exists($application->cv),
                'directory_exists' => Storage::exists('private/cvs'),
                'directory_contents' => Storage::files('private/cvs'),
            ]);
        }

        return response()->file(storage_path('app/' . $application->cv));
    }

    public function updateStatus(Request $request, $jobPostId, $userId)
    {
        $application = Application::where('job_post_id', $jobPostId)
                                ->where('user_id', $userId)
                                ->firstOrFail();

        if (Auth::id() !== $application->jobPost->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $application->status = $request->status;
        $application->save();

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
}