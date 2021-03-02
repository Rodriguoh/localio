<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'fb_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get User's role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get User's favorite stores
     */
    public function favoritesStores()
    {
        return $this->belongsToMany(Store::class, 'user_store', 'user_id', 'store_id');
    }

    /**
     * Get all moderation the user has done
     */
    public function moderations()
    {
        return $this->hasMany(Moderation::class);
    }

    /**
     * Get all user's stores
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Get all avis posted by the user
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Know if a user has a role
     * @param string $roleName
     * @return bool
     */
    public function hasRole(string $roleName)
    {
        return $this->role()->where('name', $roleName)->exists();
    }
}
