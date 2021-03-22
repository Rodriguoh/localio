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
        $users = User::paginate(8);
        $roles = Role::all();
        return view('pages/account/users/listUsers', [
            'users' => $users,
            'roles' => $roles,
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

    public function editRoleUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'role' => 'required',
        ]);

        $user = User::findOrFail($request->id);
        $user->role_id = $request->role;
        $user->save();

        return redirect()->back()->with($user->wasChanged() ? 'successEdit' : '', 'Le rôle a bien été modifié');
    }

    public function delete()
    {
    }

    public function suspend(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'banned_until' => 'required',
        ]);
        $user = User::findOrFail($request->id);
        if ($request->banned_until == "NULL"){
            $request->banned_until = NULL;
        }
        $user->banned_until = $request->banned_until;
        $user->save();

        return redirect()->back()->with($user->wasChanged() ? 'successEdit' : '', "L'utilisateur à été suspendu jusqu'au ".$request->banned_until);
    }
}
