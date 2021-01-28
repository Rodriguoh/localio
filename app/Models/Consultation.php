<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    /**
     * Get the store who get this visit
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
