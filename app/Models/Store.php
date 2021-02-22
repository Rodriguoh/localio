<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'mail',
        'SIRET',
    ];

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
        return $this->belongsTo(City::class, 'city_INSEE', 'INSEE');
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
    public function favoritesUsers()
    {
        return $this->belongsToMany(User::class, 'user_store', 'store_id', 'user_id');
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
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Get all products from this store
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
