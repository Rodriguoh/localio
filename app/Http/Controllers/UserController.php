<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages/account/users/listUsers', [
            'users' => $users,
        ]);
    }
    public function editUsersInformations(Request $request)
    {
        $this->validate($request, [
            'email' => $request->email != Auth::user()->email ? 'required|email|unique:users,email' : 'required|email',
            'isCommercant' => 'sometimes',
            'firstname' => 'required_with:isCommercant,on',
            'lastname' => 'required_with:isCommercant,on',
            'phone' => $request->isCommercant ? 'digits:10' : '',
        ]);

        $user = User::findOrFail($request->id);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role_id = $request->isCommercant ? Role::where('name', 'owner')->first()->id : $user->role_id;
        $user->save();

        return redirect()->back()->with($user->wasChanged() ? 'successEdit' : '', 'Les modifications ont bien été prises en compte.');
    }
    public function delete()
    {
    }
    public function suspend()
    {
    }
}
