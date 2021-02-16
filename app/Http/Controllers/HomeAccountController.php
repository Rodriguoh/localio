<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeAccountController extends Controller
{
    public function index()
    {
        return view('pages/account/home');
    }
}
