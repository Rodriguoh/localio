<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the user who made this avi
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get on wich store this avi has been done
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
