<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * Get the commerce corresponding to this photo
     */
    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }
}
