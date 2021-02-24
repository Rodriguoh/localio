<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StoreController;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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


// route test ckEditor
Route::resource('Ckeditor', 'CkeditorController');
Route::post('Ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');




//Administrations routes
Route::get('/account/home', 'HomeAccountController@index')->name('homeAccount');
//-- Users
Route::get('/account/listUsers', 'UserController@index')->name('listUsers');

Route::get('/account/suspendUser', 'UserController@suspend')->name('suspendUser');

//-- Store
Route::get('/account/myStores', [StoreController::class, 'userStore'])->name('myStores'); //ok

Route::get('/account/listStores', [StoreController::class, 'index'])->name('listStores'); //ok

Route::get('/account/statsStore/{idStore}', [StoreController::class, 'statsStore'])->name('statsStore'); //ok

Route::get('/account/formStore/{idStore?}', [StoreController::class, 'formStore'])->name('createStore'); //ok

Route::get('/account/settingsAccount', 'UserController@settings')->name('settingsAccount');

Route::get('/account/showStore/{idStore}', 'StoreController@showStore')->name('showStore');
Route::get('/account/approveStore/{idStore}', 'StoreController@approve')->name('approveStore');
Route::get('/account/refuseStore/{idStore}', 'StoreController@refuse')->name('refuseStore');

Route::post('/store/form', [StoreController::class, 'postStore'])->name('postStore');
Route::post('/store/delete', [StoreController::class, 'deleteStore'])->name('deleteStore');

//--Favoris
Route::get('/account/favorites', [StoreController::class, 'myFavorites'])->name('myFavorites');
Route::get('/account/editFavorite/{idStore}', [StoreController::class, 'editFavorite'])->name('editFavorite');
Route::post('/account/deleteFavorite', [StoreController::class, 'deleteFavorite'])->name('deleteFavorite');

Route::get('/account/requestsStores', 'StoreController@requests')->name('requestsStores');
Route::get('/account/reportsStores', 'StoreController@reports')->name('reportStores');

//-- Notice
Route::get('/account/myComments', 'CommentController@comments')->name('myComments');
Route::get('/account/editComment', 'CommentController@edit')->name('editComments');
Route::get('/account/createComment', 'CommentController@create')->name('addComments');

//--About
Route::get('/legalNotices', 'AboutController@legalNotices')->name('legalNotices');
