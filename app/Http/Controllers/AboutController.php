<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function legalNotices(){
        return view('pages/about/legalNotices');
    }
}
