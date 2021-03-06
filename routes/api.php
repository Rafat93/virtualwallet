<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api','json.response'])->group(function (){
   //wallet
    Route::get('wallets','Api\WalletController@index');
    Route::get('users/{id}/wallet/my','Api\WalletController@getMyWallet');
    Route::get('users/{id}/wallet/my_balance','Api\WalletController@getMyBalance');

    //movements
    Route::get('movements','Api\MovementController@index');
    Route::get('users/{id}/movements','Api\MovementController@getMyMovements');
    Route::get('users/{id}/last','Api\MovementController@getMyLastMovements');
    Route::post('movements/expense', 'Api\MovementController@storeExpense');
    Route::post('movements/income', 'Api\MovementController@storeExpense');
    Route::put('movements/{id}','Api\MovementController@update');

    //operators


    //administrator


    //user
    Route::get('users/me', 'Api\UserController@myProfile');
    Route::get('users/{id}', 'Api\UserController@show'); //find user
    Route::post('users', 'Api\UserController@store');
    Route::put('users/{id}', 'Api\UserController@update');
    Route::put('users/{id}/password', 'Api\UserController@updatePassword');
    Route::delete('users/{id}', 'Api\UserController@destroy');


    //category
    Route::get('category', 'Api\CategoryController@index');
    Route::get('categories', 'Api\CategoryController@getExpenseTypes');




    Route::post('logout', 'Api\AuthController@logout');

});

Route::middleware(['json.response'])->group(function () {
//-------------------------Wallet Routes--------------------------------------
    Route::get('wallets/number', 'Api\WalletController@getNumberOfWallets');


//-------------------------user Routes--------------------------------------
    Route::get('users/emailavailable', 'Api\UserController@emailAvailable');
//------------------------Auth Routes---------------------------------------
    Route::post('login', 'Api\AuthController@login')->name('login');
    Route::post('register', 'Api\AuthController@register')->name('register');

});
//-----------------------------Category Routes---------------------------------------------


//--------------------------------------------------------------------
