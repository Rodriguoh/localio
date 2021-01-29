<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get all store of this categorie
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Get All store of the category plus of her first stage categories child
     */
    public function getAllStoresWithAllChilds()
    {
        $result[] = $this->stores();

        foreach ($this->categoriesEnfant() as $category) {
            array_merge($result, $category->stores->get());
        }

        return $result;
    }

    /**
     * Get the parent's categorie of this categorie
     */
    public function categoryParent()
    {
        return $this->belongsTo(self::class);
    }

    /**
     * Get all categorie's child of this categorie
     */
    public function categoriesChild()
    {
        return $this->hasMany(self::class);
    }
}
