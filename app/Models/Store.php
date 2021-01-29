<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    /**
     * Get store's state
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the store's city
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the store's category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all consultation who has been done on this store
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * Get all photos of this store
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    /**
     * Get all users who has this store in favoris
     */
    public function favorisUsers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all moderation who has been done on this store
     */
    public function moderations()
    {
        return $this->hasMany(Moderation::class);
    }

    /**
     * Get all comments on this store
     */
    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }
}