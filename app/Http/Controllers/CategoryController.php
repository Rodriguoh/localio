<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id = null)
    {
        if (isset($id)) {
            $categoryParrent = Category::find($id);
            return view('pages/account/categories/categories', [
                'categoryParrent' => $categoryParrent,
                'categories' => $categoryParrent->categoriesChild()->paginate(8),
            ]);
        } else {
            $categories = Category::where('category_id', null)->paginate(8);
            return view('pages/account/categories/categories', [
                'categories' => $categories,
            ]);
        }
    }

    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        if (!$category->isUse()) {
            $category->delete();
            return redirect()->back()->with('successDelete', 'Catégorie supprimée.');
        } else {
            return redirect()->back();
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'label' => 'required|unique:categories,label'
        ]);

        $category = new Category();
        $category->label = $request->label;
        $category->category_id = $request->category_id ?? null;
        $category->save();

        return redirect()->back()->with('successAdd', 'Catégorie ajoutée.');
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:categories,id',
            'label' => 'required|unique:categories,label'
        ]);

        $category = Category::find($request->id);
        $category->label = $request->label;
        $category->save();

        return redirect()->back()->with('successEdit', 'Catégorie modifiée.');
    }
}
