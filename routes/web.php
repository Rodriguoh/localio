<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StoreController;

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


Route::get('/homeAccount', 'HomeAccountController@index')->name('homeAccount');
Route::get('/store/form/{idStore?}', [StoreController::class, 'formStore'])->name('formStore');
Route::post('/store/form', [StoreController::class, 'postStore'])->name('postStore');
