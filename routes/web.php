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

Route::middleware('auth')->group(function () {
    Route::prefix('records')->group(function (){
        Route::get('/', 'App\Http\Controllers\RecordController@RecordView')->name('record');
        Route::post('/addrecord', 'App\Http\Controllers\RecordController@AddRecord');
        Route::get('/return/{id}', 'App\Http\Controllers\RecordController@returnBook');
        Route::post('/delete', 'App\Http\Controllers\RecordController@Delete');
        Route::post('/idfilter', 'App\Http\Controllers\RecordController@idFilter');
    });
    Route::prefix('library')->group(function () {
        Route::get('/', 'App\Http\Controllers\LibraryController@libraryView')->name('library');
        Route::post('/addbook', 'App\Http\Controllers\LibraryController@addToLibrary');
        Route::get('/takebook/{id}', 'App\Http\Controllers\RecordController@takeBook');
        Route::post('/book/{id}/deletebook', 'App\Http\Controllers\LibraryController@deleteBook');
        Route::post('/book/{id}/addbook', 'App\Http\Controllers\LibraryController@addBook');
        Route::post('/libraryTitleFilter', 'App\Http\Controllers\LibraryController@libraryTitleFilter');
        Route::post('/libraryAuthorFilter', 'App\Http\Controllers\LibraryController@libraryAuthorFilter');
        Route::get('/book/{id}', 'App\Http\Controllers\LibraryController@takeBook');
    });
    Route::get('/registerorganization', 'App\Http\Controllers\OrganizationRegisterController@orgRegisterView')->name('orgRegisterView');
    Route::post('/confirmorg', 'App\Http\Controllers\OrganizationRegisterController@orgRegisterConfirm');
    Route::get('/profile','App\Http\Controllers\ProfileController@profileView')->name('profile');
    Route::get('/adminconfirm', 'App\Http\Controllers\AdminConfirmController@adminConfirmView');
    Route::post('/adminconfirmreq', 'App\Http\Controllers\AdminConfirmController@adminConfirmReq');
    Route::get('/readers', 'App\Http\Controllers\ReaderController@ReaderView');
    Route::post('/readers/surnameFilter', 'App\Http\Controllers\ReaderController@readerFilterBySurname');
    Route::post('/readers/emailFilter', 'App\Http\Controllers\ReaderController@readerFilterByEmail');
    Route::get('/takenbook','App\Http\Controllers\RecordController@takenBookView');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

