<?php

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
//profil

/////ddashboard start////


Route::get('dashboard', 'UserController@indexd');
Route::get('getannonceForD', 'UserController@getannonceForD');
Route::get('getUsers', 'UserController@getUsers');
Route::get('getnonapprouve', 'UserController@getnonapprouve');

Route::get('dashboard/annonce/{num}', 'AnnanceController@getAnnonceD');

Route::get('getannonceForEdite/{num}', 'AnnanceController@getannonceForEdite');








/////ddashboard end//////
Route::put('updatepasse', 'UserController@updatePasse');

Route::put('updateuser', 'UserController@updateUser');
Route::get('getannonce', 'UserController@getAnnonce');
Route::delete('deleteannonce/{id}', 'UserController@deletAnnonce');
Route::get('dashboard/categorie', 'PieaceController@index');

Route::get('getannonce', 'UserController@getAnnonce');

Route::post('addville', 'UserController@addVille');
Route::put('users/{id}/storePass','UserController@storePass');
///end profil

Route::get('annonces/Contact', 'UserController@Contact');

//annonce index

Route::get('annonce/getmodule/{mar}', 'AnnanceController@getmodulef');
Route::get('annonce/getmotorisation/{mad}/{mar}', 'AnnanceController@getmotorisationf');


Route::get('annonce/getidville/{cat}', 'AnnanceController@getidville');
Route::get('annonce/getscategorie/{cat}', 'AnnanceController@getscategorie');
Route::get('annonce/getpiece/{scat}', 'AnnanceController@getpiecef');




Route::get('annonce/getannonce', 'AnnanceController@getAnnonceindex');
Route::get('annonce/filter/{mar}/{mod}/{mot}/{cat}/{scat}/{pc}/{ville}', 'AnnanceController@filtrer');
//end annonce index

//whishs////////
Route::post('addwish', 'WhishController@addwish');
Route::get('getwish', 'WhishController@getwish');
Route::delete('deletewish/{id}', 'WhishController@deletewish');

//end whishs////////


////edit annonce
Route::get('getannoncetoedit/{id}', 'AnnanceController@getAnnonce');
Route::get('getmodule/{id}', 'AnnanceController@getModule');
Route::get('getmot/{id}', 'AnnanceController@getMot');
Route::get('getscat/{id}', 'AnnanceController@getscat');
Route::get('getpiece/{id}', 'AnnanceController@getpiece');
Route::get('getid/{id}', 'AnnanceController@getid');
Route::get('getidv/{id}/{id2}/{id3}', 'AnnanceController@getidc');
Route::put('updateannonce', 'AnnanceController@updateAnnonce');


///end edite annonce

//hh

Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::get('/','WelcomeController@index');

Route::get('getscat/{id}', 'WelcomeController@getscat');
Route::get('getcat', 'WelcomeController@getcat');
Route::get('profil','UserController@index');

//Route::resouece('annances', 'AnnanceController');


Route::get('annances', 'AnnanceController@index');
Route::get('annonces/create', 'AnnanceController@create');
Route::post('annances', 'AnnanceController@store');



Route::get('annances/{id}/edit', 'AnnanceController@edit');
Route::put('annances/{id}', 'AnnanceController@update');
Route::delete('annances/{id}', 'AnnanceController@destroy');
Route::get('annances/{id}', 'AnnanceController@show');
Route::get('annonces/{cat}/{scat}', 'AnnanceController@indexbycat');
Route::get('annonce/getfac', 'AnnanceController@getfac');


////Route::resouece('annances', 'AnnancecController');
Route::post('annancecs', 'AnnoncecController@store');



// Auth::routes();


Route::post('annances/fetch', 'AnnanceController@fetch')->name('annancecontroller.fetch');




Route::get('/home', 'HomeController@index')->name('home');
// Auth::routes(); //--------------------
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware('auth', 'verified')->group(function () {
    Route::resource('image', 'ImageController', [
        'only' => ['create', 'store', 'destroy', 'update']
    ]);
});
