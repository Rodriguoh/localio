<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\QueryScopesTraits;

class City extends Model
{
    use HasFactory;
    use QueryScopesTraits;

    protected $fillable = [
        'name',
        'INSEE',
        'ZIPcode',
    ];

    /**
     * Get all store in the city
     */
    public function stores()
    {
        return $this->hasMany(Store::class, 'store_INSEE', 'INSEE');
    }
}
