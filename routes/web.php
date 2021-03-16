<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;


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
Route::get('/account/listUsers', 'UserController@index')->name('listUsers')->middleware('role:admin');

Route::get('/account/suspendUser', 'UserController@suspend')->name('suspendUser')->middleware('role:admin');

Route::post('/account/editUserInformations', [UserController::class, 'editUsersInformations'])->name('editUsersInformations');

//Modif rôle user
Route::post('/account/editRoleUser', [UserController::class, 'editRoleUser'])->name('editRoleUser')->middleware('role:admin');

//-- Store
Route::get('/account/myStores', [StoreController::class, 'userStore'])->name('myStores')->middleware('role:owner'); //ok

Route::get('/account/listStores', [StoreController::class, 'index'])->name('listStores')->middleware('role:moderator'); //ok

Route::get('/account/statsStore/{idStore}', [StoreController::class, 'statsStore'])->name('statsStore')->middleware('role:owner'); //ok

Route::get('/account/formStore/{idStore?}', [StoreController::class, 'formStore'])->name('createStore')->middleware('role:owner'); //ok

Route::get('/account/settingsAccount', 'UserController@settings')->name('settingsAccount');

Route::get('/account/showStore/{idStore}', 'StoreController@showStore')->name('showStore');
Route::get('/account/approveStore/{idStore}', 'StoreController@approve')->name('approveStore')->middleware('role:moderator');
Route::get('/account/refuseStore/{idStore}', 'StoreController@refuse')->name('refuseStore')->middleware('role:moderator');


Route::post('/store/form', [StoreController::class, 'postStore'])->name('postStore')->middleware('role:owner');
Route::post('/store/delete', [StoreController::class, 'deleteStore'])->name('deleteStore')->middleware('role:owner');

//--Favoris
Route::get('/account/favorites', [FavoriteController::class, 'myFavorites'])->name('myFavorites');
Route::get('/account/editFavorite/{idStore}', [FavoriteController::class, 'editFavorite'])->name('editFavorite');
Route::post('/account/deleteFavorite', [FavoriteController::class, 'deleteFavorite'])->name('deleteFavorite');


Route::get('/account/requestsStores', 'StoreController@requests')->name('requestsStores')->middleware('role:moderator');
Route::get('/account/reportsStores', 'StoreController@reports')->name('reportStores');

//-- Notice
Route::get('/account/myComments', [CommentController::class, 'comments'])->name('myComments')->middleware('role:user');
Route::get('/account/flagComments', [CommentController::class, 'flaggedComments'])->name('flagComments')->middleware('role:moderator');
Route::post('/account/editComment', [CommentController::class, 'edit'])->name('editComment')->middleware('role:user');
Route::get('/account/createComment', [CommentController::class, 'create'])->name('addComments')->middleware('role:user');
Route::post('/comment/form', [CommentController::class, 'postComment'])->name('postComment')->middleware('role:user');
Route::post('/comment/delete', [CommentController::class, 'delete'])->name('deleteComment')->middleware('role:user');
Route::get('/legalNotices', 'AboutController@legalNotices')->name('legalNotices');
Route::get('/account/approveComment/{idComment}', 'CommentController@approve')->name('approveComment')->middleware('role:moderator');
Route::get('/account/refuseComment/{idComment}', 'CommentController@refuse')->name('refuseComment')->middleware('role:moderator');



//ADMIN
// Categories
Route::get('account/categories/{category_id?}', [CategoryController::class, 'index'])->name('categories')->middleware('role:admin');
Route::post('account/category/add', [CategoryController::class, 'add'])->name('addCategory')->middleware('role:admin');
Route::post('account/category/edit', [CategoryController::class, 'edit'])->name('editCategory')->middleware('role:admin');
Route::post('account/category/delete', [CategoryController::class, 'delete'])->name('deleteCategory')->middleware('role:admin');

// Statistique
Route::get('account/statistiques', [StoreController::class, 'stats'])->name('statistiques')->middleware('role:admin');
