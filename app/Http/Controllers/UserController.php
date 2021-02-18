<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('pages/account/users/listUsers',[
            'users' => $users,
        ]);
    }
    public function edit($id){
        $user = User::find($id);
        return view("pages/account/users/editUser/$id",[
            'user' => $user,
        ]);
    }
    public function create(){

    }
    public function delete(){

    }
    public function suspend(){

    }
    public function settings(){
        $user = Auth::user();
        return view("pages/account/users/settingsAccount",[
            'user' => $user,
        ]);
    }
}
