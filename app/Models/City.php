<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * Get all store in the city
     */
    public function stores()
    {
        return $this->hasMany(Store::class, 'store_INSEE', 'INSEE');
    }
}
