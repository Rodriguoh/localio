<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryParentRessource;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CategoryParentRessource::collection(Category::where('category_id', '=', null)->get());
        $favorites = Auth::check() ? array_map(function ($st) {
            return $st['id'];
        }, Auth::user()->favoritesStores()->get()->toArray()) : [];
        return view('pages/home/index', [
            'id_user' => Auth::id(),
            'favorites' => $favorites,
            'categories' => $categories,
        ]);
    }
}
