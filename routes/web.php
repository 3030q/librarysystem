<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
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

Route::get('/', 'App\Http\Controllers\MainController@home')->name('homesus');
Route::middleware('auth')->group(function (){
    Route::prefix('allogs')->group(function (){
        Route::get('/', 'App\Http\Controllers\MainController@allogs')->name('logs');
        Route::post('/check', 'App\Http\Controllers\MainController@allogs_check');
        Route::post('/takeDateReturn', 'App\Http\Controllers\MainController@takeDateReturn');
        Route::post('/delete', 'App\Http\Controllers\MainController@delete');
    });

});


Route::get('/userregister','App\Http\Controllers\RegisterUserController@registerUserView');
Route::post('/userregisterconfirm','App\Http\Controllers\RegisterUserController@registerUserConfirm');


Route::get('/registerorganization','App\Http\Controllers\Auth\OrganizationRegisterController@orgRegisterView')->name('orgRegisterView');
Route::post('/confirmorg','App\Http\Controllers\Auth\OrganizationRegisterController@orgRegisterConfirm');


Route::get('/profile','App\Http\Controllers\ProfileController@profileView')->name('profile');
Route::get('/adminconfirm', 'App\Http\Controllers\AdminConfirmController@adminConfirmView');
Route::post('/adminconfirmreq', 'App\Http\Controllers\AdminConfirmController@adminConfirmReq');



Route::get('/library', 'App\Http\Controllers\LibraryController@libraryView')->name('library');
Route::post('/addbook', 'App\Http\Controllers\LibraryController@addToLibrary');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

