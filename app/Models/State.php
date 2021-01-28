<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    /**
     * Get all stores with this state
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
