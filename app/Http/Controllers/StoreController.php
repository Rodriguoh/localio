<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formStore($idStore = null)
    {
        $store = Store::find($idStore);
        //dd(isset($store));
        return view('pages/account/formStore', [
            'store' => isset($store) ? $store : new Store()
        ]);
    }

    public function postStore(Request $req) {
        dd($req);
    }
}
