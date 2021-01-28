<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    use HasFactory;

    /**
     * Get commerce's state
     */
    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }

    /**
     * Get the commerce's city
     */
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    /**
     * Get the commerce's categorie
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Get all consultation who has been done on this commerce
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * Get all photos of this commerce
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    /**
     * Get all users who has this commerce in favoris
     */
    public function favorisUsers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all moderation who has been done on this commerce
     */
    public function moderations()
    {
        return $this->hasMany(Moderation::class);
    }

    /**
     * Get all avis on this commerce
     */
    public function avis()
    {
        return $this->hasMany(Avi::class);
    }
}
