<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\StoreSimpleResource;
use App\Http\Resources\StoreThumbResource;
use App\Http\Resources\StoreResource;
use App\Http\Resources\CommentsCollection;

use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\State;
use App\Models\Category;
use App\Models\Comment;

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
        return StoreSimpleResource::collection(
            Store::where('name', 'LIKE', '%' . $name . '%')
                ->where('state_id', State::select('id')
                    ->where('label', '=', 'approved')
                    ->first()->id)
                ->get()
        );
    }

    /**
     * Get complete detail for a store
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function getStore(string $id)
    {
        return new StoreResource(Store::find($id));
    }


    /**
     * Get all comments on a store with paginate
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function getStoreComments(string $id)
    {
        return new CommentsCollection(Comment::where('store_id', '=', $id)->paginate(2));
    }


    /**
     * Get all store contains on a map section and who are activated
     * We also are looking at if the has the category or if his category
     * has the category needed in parents.
     *
     * @param Request $request
     * params needed :
     *  - lat_ne
     *  - lng_ne
     *  - lat_sw
     *  - lng_sw
     *  - category (optionnal)
     *
     * @throws Error 500 if params are missings
     * @return \Illuminate\Http\Response
     */
    public function getStoresOnMap(Request $request)
    {
        if (!isset($request->lat_ne) || !isset($request->lng_ne) || !isset($request->lat_sw) || !isset($request->lng_sw)) {
            return response()->json(['error' => 'You need to pass at least lat_ne, lng_ne, lat_sw, lng_sw in our request params'], 500);
        }

        if (isset($request->category)) {
            $stores = Store::select('*')
                ->whereBetween('lat', [$request->lat_sw, $request->lat_ne])
                ->whereBetween('lng', [$request->lng_sw, $request->lng_ne])
                ->whereIn('category_id', array_merge( // check for category
                    [
                        $request->category
                    ],
                    array_map( // get all category's childs
                        function ($cat) {
                            return $cat['id'];
                        },
                        Category::select('id')
                            ->where('category_id', '=', $request->category)
                            ->get()
                            ->toArray()
                    )
                ))
                ->where('state_id', State::select('id')->where('label', '=', 'approved')->first()->id) // check for approved state
                ->get();
        } else {
            $stores = Store::select('*')
                ->whereBetween('lat', [$request->lat_sw, $request->lat_ne])
                ->whereBetween('lng', [$request->lng_sw, $request->lng_ne])
                ->where('state_id', State::select('id')->where('label', '=', 'approved')->first()->id)
                ->get();
        }
        return StoreThumbResource::collection($stores);
    }
}
