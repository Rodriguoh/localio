<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Exception;
use Auth;
use App\Models\Role;
use Str;

class FacebookController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
            $driver = Socialite::driver('facebook')
                ->fields([
                    'name',
                    'first_name',
                    'last_name',
                    'email'
                ]);
                $user = $driver->user();

            $isUser = User::where('fb_id', $user->id)->first();
            if ($isUser) {
                Auth::login($isUser);
                return redirect()->route('homeAccount');
            } else {
                $newUser = new User;
                $newUser->firstname = $user->user['first_name'];
                $newUser->lastname = $user->user['last_name'];
                $newUser->email = $user->email;
                $newUser->fb_id = $user->id;
                $newUser->role_id = Role::where('name', 'user')->first()->id;
                $newUser->remember_token = Str::random(10);
                $newUser->save();

                Auth::login($newUser);
                return redirect()->route('homeAccount');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
