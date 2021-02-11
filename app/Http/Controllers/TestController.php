<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use \App\Models\City;

class TestController extends Controller
{
    public function index(){
        dd(City::whereLike('name', 'ontpel')->get());
    }

}
