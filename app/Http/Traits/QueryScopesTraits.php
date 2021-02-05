<?php

namespace App\Http\Traits;
trait QueryScopesTraits
{
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%' . $value . '%');
    }
}
