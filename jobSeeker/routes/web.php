<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppliedJobsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', [HomeController::class, 'dashboard'])->name('home'); // Changed name to 'home'

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Routes that require authentication and employer role
Route::middleware(['auth', 'employer'])->group(function () {
    Route::get('job-posts/create', [JobPostController::class, 'create'])->name('job-posts.create');
    Route::post('job-posts', [JobPostController::class, 'store'])->name('job-posts.store');
    Route::get('job-posts/{jobPost}/edit', [JobPostController::class, 'edit'])->name('job-posts.edit');
    Route::put('job-posts/{jobPost}', [JobPostController::class, 'update'])->name('job-posts.update');
    Route::delete('job-posts/{jobPost}', [JobPostController::class, 'destroy'])->name('job-posts.destroy');
    Route::get('my-jobs', [JobPostController::class, 'myJobs'])->name('job-posts.myJobs');
    Route::get('job-posts/{jobPost}/applicants', [JobPostController::class, 'showApplicants'])->name('job-posts.showApplicants');
    Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
    Route::patch('/applications/{jobPostId}/{userId}/update-status', [ApplicationController::class, 'updateStatus'])
        ->name('applications.updateStatus');
    Route::get('/cv/{jobPostId}/{userId}', [ApplicationController::class, 'viewCV'])->name('cv.view');
    Route::post('job-posts/{jobPost}/apply', [ApplicationController::class, 'apply'])->name('job-posts.apply');
});

// Routes that require authentication and job-seeker role
Route::middleware(['auth', 'job_seeker'])->group(function () {
    Route::get('/applied', [AppliedJobsController::class, 'index'])->name('applied');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('job-posts/{jobPost}/apply', [ApplicationController::class, 'apply'])->name('job-posts.apply');
    Route::patch('applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
});

// Routes that require authentication and admin role
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/add-user', [AdminController::class, 'showAddUserForm'])->name('admin.addUserForm');
    Route::post('/admin/add-user', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/manage-jobs', [AdminController::class, 'manageJobs'])->name('admin.manageJobs');
    Route::delete('/admin/delete-job/{id}', [AdminController::class, 'deleteJob'])->name('admin.deleteJob');
});

// Resource route for JobPostController
Route::resource('job-posts', JobPostController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Include authentication routes
require __DIR__.'/auth.php';
