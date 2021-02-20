<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\State;
use App\Models\Store;
use App\Models\City;
use App\Models\Moderation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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
    public function showStore($idStore)
    {
        $store = Store::where('stores.id', $idStore)
            ->join('users', 'users.id', '=', 'stores.user_id')
            ->join('states', 'states.id', '=', 'stores.state_id')
            ->join('cities', 'cities.insee', '=', 'stores.city_insee')
            ->join('categories', 'categories.id','=','stores.category_id')
            ->select('users.lastname', 'users.firstname',
                     'stores.description', 'stores.number', 'stores.street', 'stores.name as store_name', 'stores.created_at','stores.state_id','stores.siret','stores.phone','stores.codeComment','stores.mail','stores.url','stores.lat', 'stores.lng', 'stores.delivery','stores.conditionDelivery','stores.openingHours',
                     'city_insee', 'cities.name as city_name', 
                     'categories.label as category_name',
                     'states.label as state_label')->first();
        return view('pages/account/stores/showStore', ['store' => $store])->with('openingHours', json_decode($store->openingHours, true));
        
    }
    public function approve($idStore, $idUser){
        $store = Store::find($idStore);
        $store->state_id = 2;
        $store->save();
        Moderation::create(['date' => now(), 'store_id' => $store->id, 'user_id' => $idUser, 'action' => 'approve']);
        return redirect()->route('requestsStores');
    }
    
    public function refuse($idStore,$idUser){
        $store = Store::find($idStore);
        $store->state_id = 3;
        $store->save();
        Moderation::create(['date' => now(), 'store_id' => $store->id, 'user_id' => $idUser, 'action' => 'refuse']);
        return redirect()->route('requestsStores');
    }

    public function requests()
    {
        $stores = Store::join('users', 'users.id', '=', 'stores.user_id')
            ->join('states', 'states.id', '=', 'stores.state_id')
            ->select('lastname', 'firstname', 'stores.id','stores.description', 'stores.name', 'stores.created_at', 'stores.state_id', 'states.label as state_label')
            ->where('states.label', '=', 'pending')
            ->orderBy('name')
            ->paginate(5);
        $user = Auth::user();
        return view('pages/account/stores/moderateRequestsStore', ['stores' => $stores, 'user' => $user]);
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
