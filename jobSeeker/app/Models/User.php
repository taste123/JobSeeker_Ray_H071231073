<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'skills',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills' => 'array',
    ];

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function appliedJobs()
    {
        return $this->belongsToMany(JobPost::class, 'applications')
                    ->withPivot('created_at', 'status');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

