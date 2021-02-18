<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
class StoreController extends Controller
{
    public function index(){
        $stores = Store::all();
        return view('pages/account/stores/listStores',[
            'stores' => $stores,
        ]);
    }
    public function create(){
        return view('pages/account/stores/addStore');
    }
    public function edit(){

    }

    public function delete(){

    }
    public function manage(){

    }
    public function requests(){
        $stores = Store::where('state_id', 1);
        return view('pages/account/stores/moderateRequestsStore');
    }
    public function reports(){
        
    }
    public function userStore(){
        $stores = Store::where('user_id',Auth::user()->id);
        return view('pages/account/stores/myStores',[
            'stores' => $stores
        ]);
    }
}
