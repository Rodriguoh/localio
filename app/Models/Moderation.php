<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    use HasFactory;

    /**
     * Get on wich commerce this moderation has been done
     */
    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }

    /**
     * Get the user who made this moderation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
