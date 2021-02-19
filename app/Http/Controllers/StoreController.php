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
        $stores = Store::orderBy('name')->paginate(8);
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
        $stores = Store::where('state_id', 1);
        return view('pages/account/stores/moderateRequestsStore');
    }
    public function reports()
    {
    }
    public function userStore()
    {
        $stores = Store::where('user_id', Auth::user()->id)->orderBy('name')->paginate(8);
        return view('pages/account/stores/myStores', [
            'stores' => $stores
        ]);
    }

    public function statsStore($idStore)
    {
        return view('pages/account/stores/statsStore', [
            'store' => Store::find($idStore)
        ]);
    }

    public function formStore($idStore = null)
    {
        $store = Store::find($idStore);
        if (isset($store)) {
            return view('pages/account/stores/editStoreForm', [
                'store' => $store,
                'categories' => Category::getCategoriesWithChild(),
            ]);
        } else {
            return view('pages/account/stores/addStoreForm', [
                'store' => new Store(),
                'categories' => Category::getCategoriesWithChild(),
            ]);
        }
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

        $store = new Store();
        $store->name = $request->name;
        $store->phone = $request->phone;
        $store->mail = $request->mail;
        $store->SIRET = $request->SIRET;

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
