<?php

use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


$groupData = [
    //'namespace' => 'Messenger\Manager',
    'prefix' => 'manager'
];

Route::group($groupData, function(){
    //BlogCategory
    $methods = ['index', 'show', ];

    Route::resource('claims', 'ClaimController')
        ->only($methods)
        ->names('manager.claims');
});


//Route::group(['prefix' => 'manager', 'as' => 'manager::', 'middleware' => ['manager']], function () {
//
//    Route::get('/', 'ManagerController@index')
//        ->name('manager');
//
//    $methods = ['show',];
//    Route::resource('claims', 'ClaimController')
//        ->only($methods)
//        ->names('manager.claim');
//
//});
Route::group(['prefix' => 'client', 'as' => 'client::', 'middleware' => ['client']], function () {

    Route::get('/', 'ClientController@index')
        ->name('client');

});

