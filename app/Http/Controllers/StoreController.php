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

    public function index()
    {
        $stores = Store::all();
        return view('pages/account/stores/listStores', [
            'stores' => $stores,
        ]);
    }

    public function create()
    {
        return view('pages/account/stores/addStore');
    }
    public function edit()
    {
    }
    public function requests()
    {
        $stores = Store::where('state_id',1)->join('users', 'users.id', '=', 'stores.user_id')->select('lastname','firstname','stores.description', 'stores.name', 'stores.created_at', 'stores.state_id')->paginate(5);
        //dd($stores);
        return view('pages/account/stores/moderateRequestsStore', ['stores' => $stores]);
    }
    public function reports()
    {
    }
    public function userStore()
    {
        $stores = Store::where('user_id', Auth::user()->id);
        return view('pages/account/stores/myStores', [
            'stores' => $stores
        ]);
    }

    public function formStore($idStore = null)
    {
        $store = Store::find($idStore);
        return view('pages/account/stores/formStore', [
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
