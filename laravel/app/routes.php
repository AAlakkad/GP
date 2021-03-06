<?php

Route::get( '/', function () {
    return View::make( 'layout.master', [ 'content' => 'Hello!' ] );
} );

Route::get( '/search/{ids?}', [ 'as' => 'search.index', 'uses' => 'SearchController@index' ] );
Route::post( '/search', [ 'as' => 'search.post', 'uses' => 'SearchController@doSearch' ] );

Route::group(['before' => 'auth'], function() {
    Route::resource( 'ingredients', 'IngredientsController' );
    Route::resource( 'recipes', 'RecipesController' );
    Route::resource( 'metas', 'MetasController' );
});

// Confide routes
Route::get( 'users/create', 'UsersController@create' );
Route::post( 'users', 'UsersController@store' );
Route::get( 'users/login', 'UsersController@login' );
Route::post( 'users/login', 'UsersController@doLogin' );
Route::get( 'users/confirm/{code}', 'UsersController@confirm' );
Route::get( 'users/forgot_password', 'UsersController@forgotPassword' );
Route::post( 'users/forgot_password', 'UsersController@doForgotPassword' );
Route::get( 'users/reset_password/{token}', 'UsersController@resetPassword' );
Route::post( 'users/reset_password', 'UsersController@doResetPassword' );
Route::get( 'users/logout', 'UsersController@logout' );
