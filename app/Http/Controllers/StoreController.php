<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\State;
use App\Models\Store;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formStore($idStore = null)
    {
        $store = Store::find($idStore);
        return view('pages/account/formStore', [
            'store' => isset($store) ? $store : new Store(),
            'categories' => Category::getCategoriesWithChild(),
        ]);
    }

    public function postStore(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|digits:10',
            'mail' => 'required|email',
            'SIRET' => 'required|digits:14',
            'url' => 'url',
            'category_id' => 'required|exists:categories,id',
            'number' => 'required',
            'street' => 'required',
            'city' => 'required',
        ]);

        $store = new Store([
            'name' => $request->name,
            'phone' => $request->phone,
            'mail' => $request->mail,
            'SIRET' => $request->SIRET,
        ]);

        $store->codeComment = Str::random(10);
        $store->category_id = $request->category_id;
        $store->url = $request->url;
        $store->description = $request->editor;
        $store->delivery = isset($request->delivery);
        $store->conditionDelivery = $store->delivery ? $request->conditionDelivery : null;
        $store->user_id = Auth::id();
        $store->state_id = State::select('id')->where('label', '=', 'approved')->first()->id;

        // adresse
        $store->number = $request->number;
        $store->street = $request->street;

        if (City::where('name', '=', $request->city)->exists()) {
            $store->city_INSEE = City::where('name', '=', $request->city)->first()->INSEE;
        } else {
            $city = new City([
                'name' => $request->city,
                'ZIPcode' => $request->ZIPCode,
                'INSEE' => $request->INSEE,
            ]);

            $city->save();
            $store->city_INSEE = $city->INSEE;
        }


        //localisation provisoire
        $store->lng = $request->lng;
        $store->lat = $request->lat;

        $store->save();

        return redirect()->route('homeAccount');
    }
}
