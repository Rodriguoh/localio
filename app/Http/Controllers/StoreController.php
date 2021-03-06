<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\State;
use App\Models\Store;
use App\Models\City;
use App\Models\User;
use App\Models\Comment;
use App\Models\Consultation;
use App\Models\Moderation;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stores = Store::orderBy('name')->with('city', 'state')->paginate(8);
        return view('pages/account/stores/listStores', [
            'stores' => $stores,
        ]);
    }

    public function create()
    {
        return view('pages/account/stores/addStore');
    }

    public function showStore($idStore)
    {
        $store = Store::findOrFail($idStore);
        return view('pages/account/stores/showStore', ['store' =>  $store])->with('openingHours', json_decode($store->openingHours, true));
    }
    public function approve($idStore)
    {
        $store = Store::findOrFail($idStore);
        $store->state_id = State::where('label', '=', 'approved')->first()->id;
        $store->save();
        Moderation::create(['date' => now(), 'store_id' => $store->id, 'user_id' => Auth::user()->id, 'action' => 'approve']);
        return redirect()->route('listStores');
    }

    public function refuse($idStore)
    {
        $store = Store::findOrFail($idStore);
        $store->state_id = State::where('label', '=', 'refused')->first()->id;
        $store->save();
        Moderation::create(['date' => now(), 'store_id' => $store->id, 'user_id' => Auth::user()->id, 'action' => 'refuse']);
        return redirect()->route('listStores');
    }

    public function requests()
    {
        $stores = Store::join('users', 'users.id', '=', 'stores.user_id')
            ->join('states', 'states.id', '=', 'stores.state_id')
            ->join('cities', 'cities.INSEE', '=', 'stores.city_INSEE')
            ->select('lastname', 'firstname', 'stores.id', 'stores.description', 'stores.name', 'stores.created_at', 'stores.state_id', 'states.label as state_label', 'cities.name as city_name')
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
        $stores = Auth::user()->stores()->with('state', 'city')->orderBy('name')->paginate(8);
        return view('pages/account/stores/myStores', [
            'stores' => $stores
        ]);
    }

    public function statsStore($idStore)
    {
        $store = Store::findOrFail($idStore);

        $consultationsByMonth = ["January", "February", "March", "April", "June", "July", "August", "September", "October", "November", "December"];

        // get count consultation group by month for the last 12 month
        $consultations = $store->consultations()
            ->where("date", ">", Carbon::now()->subMonths(12))
            ->orderBy('date')
            ->get()
            ->groupBy(function ($d) {
                return Carbon::parse($d->date)->format('F');
            })
            ->map
            ->count();

        $consultationsResult = [];

        // fill consultations with 0 by empty month
        foreach ($consultationsByMonth as $month) {
            $consultationsResult[$month] = $consultations[$month] ?? 0;
        }

        return view('pages/account/stores/statsStore', [
            'store' => $store,
            'consultations' => $consultationsResult
        ]);
    }

    public function formStore($idStore = null)
    {

        if (isset($idStore)) {
            return view('pages/account/stores/editStoreForm', [
                'store' => Store::findOrFail($idStore),
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
            'name' => 'required|max:100',
            'short_description' => 'required|max:255',
            'photo' => isset($request->id) ? '' : 'required|image',
            'phone' => 'required|digits:10',
            'mail' => 'required|email',
            'SIRET' => 'required|digits:14',
            'url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'number' => 'required|max:15',
            'street' => 'required|max:45',
            'city' => 'required',
            'lat' => 'required',
            'INSEE' => 'required',
            'ZIPCode' => 'required',
            'lng' => 'required',
        ]);

        $store = isset($request->id) ? Store::findOrFail($request->id) : new Store();
        $store->name = $request->name;
        $store->short_description = $request->short_description;
        $store->phone = $request->phone;
        $store->mail = $request->mail;
        $store->SIRET = $request->SIRET;

        $store->codeComment = Str::random(10);
        $store->category_id = $request->category_id;
        $store->url = $request->url;
        $store->description = $request->description;
        $store->delivery = isset($request->delivery);
        $store->conditionDelivery = $store->delivery ? $request->conditionDelivery : null;
        $store->user_id = Auth::id();
        $store->state_id = State::select('id')->where('label', '=', 'pending')->first()->id;

        // adresse
        $store->number = $request->number;
        $store->street = $request->street;

        if (City::where('INSEE', '=', $request->INSEE)->exists()) {
            $store->city_INSEE = City::where('INSEE', '=', $request->INSEE)->first()->INSEE;
        } else {
            $city = new City([
                'name' => $request->city,
                'ZIPcode' => explode(',',$request->ZIPCode)[0],
                'INSEE' => $request->INSEE,
            ]);

            $city->save();
            $store->city_INSEE = $city->INSEE;
        }

        //localisation provisoire
        $store->lng = $request->lng;
        $store->lat = $request->lat;

        $store->save();

        $photo = isset($request->id) ? Photo::where('store_id', $request->id)->first() : new Photo();
        if ($request->hasFile('photo')) {
            $originName = $request->file('photo')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            //$request->file('photo')->move(public_path('images/store_minia/'), $fileName);

            Storage::disk('sftp')->put($fileName, fopen($request->file('photo'),'r+')); // stock l'image sur le ftp

            $url = 'https://www.theoboudier.fr/espace-projets/localio/images/' . $fileName; // url de la photo hébergé

            $photo->url = $url;
            $photo->alt = 'Photo de ' . $store->name;
            $photo->store_id = $store->id;
            $photo->save();
        }

        if (isset($request->id)) {
            return redirect()->back()->with('success', 'Modification réussite un modérateur doit la valider');
        } else {
            return redirect()->route('myStores'); // myStores
        }
    }

    public function deleteStore(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:stores,id',
            'confirmEmail' => 'required|exists:users,email'
        ]);

        $store = Store::findOrFail($request->id);

        if (Auth::id() != $store->user_id || Auth::user()->email != $request->confirmEmail) return redirect()->back();

        $store->delete();

        return redirect()->route('myStores')->with('successDelete', 'Votre commerce a bien été supprimé');
    }

    public function stats()
    {
        $consultationsByMonth = ["January", "February", "March", "April", "June", "July", "August", "September", "October", "November", "December"];

        // get count consultation group by month for the last 12 month
        $consultations = Consultation::where("date", ">", Carbon::now()->subMonths(12))
            ->orderBy('date')
            ->get()
            ->groupBy(function ($d) {
                return Carbon::parse($d->date)->format('F');
            })
            ->map
            ->count();

        $consultationsResult = [];

        // fill consultations with 0 by empty month
        foreach ($consultationsByMonth as $month) {
            $consultationsResult[$month] = $consultations[$month] ?? 0;
        }

        $consultationsBycat = DB::select('select label, count(*) from categories inner join stores on stores.category_id = categories.id inner join consultations on stores.id = consultations.store_id group by label');

        return view('pages/account/stats', [
            'nbCommentaire' => Comment::count(),
            'nbUtilisateurs' => User::count(),
            'nbConsultations' => Consultation::count(),
            'consultations' => $consultationsResult,
            'consultationsByCat' => $consultationsBycat
        ]);
    }
}
