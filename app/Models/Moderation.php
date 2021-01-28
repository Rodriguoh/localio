<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    use HasFactory;

    /**
     * Get on wich store this moderation has been done
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the user who made this moderation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
