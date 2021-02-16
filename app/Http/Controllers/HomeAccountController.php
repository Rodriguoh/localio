<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeAccountController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('pages/account/home',[
            'user' => $user,
        ]);
       
    }

}
