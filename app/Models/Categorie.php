<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public function commerces()
    {
        return $this->hasMany(Commerce::class);
    }

    public function categorieParent()
    {
        return $this->belongsTo(self::class);
    }

    public function categoriesEnfant()
    {
        return $this->hasMany(self::class);
    }
}
