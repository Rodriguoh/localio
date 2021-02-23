<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        //dd(Socialite::driver('google')->user());
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('home');
            } else {
                $newUser = new User;
                $newUser->firstname = explode(' ', $user->name)[0];
                $newUser->lastname = explode(' ', $user->name)[1];
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->role_id = Role::where('name', 'user')->first()->id;
                $newUser->save();

                Auth::login($newUser);

                return redirect()->route('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
