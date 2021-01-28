<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    /**
     * Get all commerce in the city
     */
    public function commerces()
    {
        return $this->hasMany(Commerce::class);
    }
}
