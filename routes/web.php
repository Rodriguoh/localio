<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

// route test ckEditor
Route::resource('Ckeditor', 'CkeditorController');
Route::post('Ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');




//Administrations routes
Route::get('/account/home', 'HomeAccountController@index')->name('homeAccount');
//-- Users
Route::get('/account/listUsers', 'UserController@index')->name('listUsers'); //ok

Route::get('/account/suspendUser', 'UserController@suspend')->name('suspendUser');

//-- Store
Route::get('/account/myStores', 'StoreController@userStore')->name('myStores'); //ok

Route::get('/account/listStores', 'StoreController@index')->name('listStores'); //ok

Route::get('/account/createStore', 'StoreController@create')->name('createStore'); //ok

Route::get('/account/editStore', 'StoreController@edit')->name('editStore');

Route::get('/account/settingsAccount', 'UserController@settings')->name('settingsAccount');


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


// Log out : 
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
