<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;

    /**
     * Get all commerces with this state
     */
    public function commerces()
    {
        return $this->hasMany(Commerce::class);
    }
}
