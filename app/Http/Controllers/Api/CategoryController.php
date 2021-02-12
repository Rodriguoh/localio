<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryParentRessource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all categories with her child
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        return CategoryParentRessource::collection(Category::where('category_id', '=', null)->get());
    }
}
