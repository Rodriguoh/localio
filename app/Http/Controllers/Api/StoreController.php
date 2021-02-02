<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

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
        $store = [$name];
        return $store;
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
