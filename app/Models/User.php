<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Helper function to test is the user has admin privileges
     *
     * @return bool true if the user has the admin role
     */
    public function isAdmin() {
        return $this->role == 'admin';
    }

    /**
     * Helper function to test is the user has writer privileges
     *
     * @return bool true if the user has the writer role
     */
    public function isWriter() {
        return $this->role == 'writer';
    }

    /**
     * Helper function to test is the user's email has been verified
     *
     * @return bool true if the user has verified their email
     */
    public function isEmailVerified() {
        return $this->email_verified_at != null;
    }
}
