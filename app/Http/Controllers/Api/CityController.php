<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
class CityController extends Controller
{

    /**
     * Get a list of city for autocomplete by her name
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function getCitiesByName($name)
    {
        //$cities = 
        //\App\Models\City::where('name','like','%ontp%')->get();
        return City::whereLike('name', $name)->get();
    }
}
