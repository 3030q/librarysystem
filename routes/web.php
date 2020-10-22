<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\MainController@home');
Route::middleware('auth')->group(function (){
    Route::prefix('allogs')->group(function (){
        Route::get('/', 'App\Http\Controllers\MainController@allogs')->name('logs');
        Route::post('/check', 'App\Http\Controllers\MainController@allogs_check');
        Route::post('/takeDateReturn', 'App\Http\Controllers\MainController@takeDateReturn');
        Route::post('/delete', 'App\Http\Controllers\MainController@delete');
    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
