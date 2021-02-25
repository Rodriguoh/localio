<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function myFavorites()
    {

        return view('pages/account/favorites/viewFavorites', [
            'favorites' => Auth::user()
                ->favoritesStores()
                ->with('category')
                ->where('state_id', State::select('id')
                    ->where('label', '=', 'approved')
                    ->first()->id)
                ->paginate(6),
        ]);
    }

    public function editFavorite($idStore)
    {
        return view('pages/account/favorites/editFavorite', ['store' => Store::find($idStore)]);
    }

    public function deleteFavorite(Request $request)
    {
        Auth::user()->favoritesStores()->detach($request->id);
        return redirect()->route('myFavorites')->with(['successDelete' => 'Favorie supprimé']);
    }
}
