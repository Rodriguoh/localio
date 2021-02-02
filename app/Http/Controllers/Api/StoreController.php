<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreSimpleResource;
use App\Http\Resources\StoreThumbResource;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;

class StoreController extends Controller
{
    /**
     * Get a list of store by her name
     *
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function getStoresByName($name)
    {
        return StoreSimpleResource::collection(Store::where('name', 'LIKE', '%' . $name . '%')->get());
    }

    /**
     * Get a detail for a store
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStore($id)
    {
        return Store::find($id);
    }


    public function getStoresOnMap()
    {
    }
}
