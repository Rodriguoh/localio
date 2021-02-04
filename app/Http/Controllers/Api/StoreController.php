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
    public function getStoresByName(string $name)
    {
        return StoreSimpleResource::collection(Store::where('name', 'LIKE', '%' . $name . '%')->get());
    }

    /**
     * Get a detail for a store
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function getStore(string $id)
    {
        return Store::find($id);
    }


    public function getStoresOnMap(Request $request)
    {
        if (!isset($request->lat_ne) || !isset($request->lng_ne) || !isset($request->lat_sw) || !isset($request->lng_sw)) {
            return response()->json(['error' => 'You need to pass at least lat_ne, lng_ne, lat_sw, lng_sw in our request params'], 500);
        }

        $stores = Store::select('*')
            ->whereBetween('lat', [$request->lat_sw, $request->lat_ne])
            ->whereBetween('lng', [$request->lng_sw, $request->lng_ne])
            ->get();
        return StoreThumbResource::collection($stores);
    }
}
