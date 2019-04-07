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
    'prefix' => 'manager'
];

Route::group($groupData, function(){
    $methods = ['index', 'show', 'update' ];

    Route::resource('claims', 'Manager\ClaimController')
        ->only($methods)
        ->names('manager.claims');
});

$groupData = [
    'prefix' => 'client'
];

Route::group($groupData, function(){
    $methods = ['index', 'show', 'destroy', 'create', 'store'];

    Route::resource('claims', 'Client\ClaimController')
        ->only($methods)
        ->names('client.claims');
});
