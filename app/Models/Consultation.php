<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    /**
     * Get the commerce who get this visit
     */
    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }
}
