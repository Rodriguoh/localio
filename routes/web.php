<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StoreController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('exemple', function () {
    return view('pages/exemple');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Création d'une route vers TestController pour effectuer des tests
Route::get('/test', [TestController::class, 'index']);

require __DIR__ . '/auth.php';

//Mot de passe oublié
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
//Ré-initialiser son mot de passe:
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


// route test ckEditor
Route::resource('Ckeditor', 'CkeditorController');
Route::post('Ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');




//Administrations routes
Route::get('/account/home', 'HomeAccountController@index')->name('homeAccount');
//-- Users
Route::get('/account/listUsers', 'UserController@index')->name('listUsers'); 

Route::get('/account/suspendUser', 'UserController@suspend')->name('suspendUser');

//-- Store
Route::get('/account/myStores', [StoreController::class, 'userStore'])->name('myStores'); 
Route::get('/account/listStores', [StoreController::class, 'index'])->name('listStores'); 
Route::get('/account/createStore', [StoreController::class, 'formStore'])->name('createStore'); 
Route::get('/account/editStore', 'StoreController@edit')->name('editStore');
Route::get('/account/settingsAccount', 'UserController@settings')->name('settingsAccount');

Route::get('/account/showStore/{idStore}', 'StoreController@showStore')->name('showStore');
Route::get('/account/approveStore/{idStore}/{idUser}','StoreController@approve')->name('approveStore');
Route::get('/account/refuseStore/{idStore}/{idUser}','StoreController@refuse')->name('refuseStore');

// Route::get('/store/form/{idStore?}', [StoreController::class, 'formStore'])->name('formStore');
Route::post('/store/form', [StoreController::class, 'postStore'])->name('postStore');



Route::get('/account/requestsStores', 'StoreController@requests')->name('requestsStores');
Route::get('/account/reportsStores', 'StoreController@reports')->name('reportStores');

//-- Notice
Route::get('/account/myComments', 'CommentController@comments')->name('myComments');
Route::get('/account/editComment', 'CommentController@edit')->name('editComments');
Route::get('/account/createComment', 'CommentController@create')->name('addComments');

//-- Favorite
Route::get('/account/myFavorites', 'FavoriteController@edit')->name('editFavorite');
Route::get('/account/editFavorite', 'FavoriteController@edit')->name('editFavorite');
Route::get('/account/createFavorite', 'FavoriteController@create')->name('addFavorite');
