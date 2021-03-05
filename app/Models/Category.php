<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CategoryParentRessource;

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

    public static function getCategoriesWithChild()
    {
        $categories = Category::where('category_id', '=', null)->get();
        foreach ($categories as $category) {
            $category->child = Category::where('category_id', '=', $category->id)->get();
        }
        return $categories;
    }

    public function isUse()
    {
        if ($this->stores()->count() > 0 || $this->categoriesChild()->count() > 0) return true;
        foreach ($this->categoriesChild()->get() as $category) {
            if ($category->stores()->count() > 0) return true;
        }
        return false;
    }
}
