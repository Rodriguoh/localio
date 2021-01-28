<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * Get the store corresponding to this photo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
