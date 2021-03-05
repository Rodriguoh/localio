<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Photo extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    /**
     * Get the store corresponding to this photo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
