<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Admin\AdminController,
    Admin\CityController,
    Admin\ImportController,
    CommentsController,
};


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'home', 'middleware' => 'auth'], function() {
    Route::resource('/', CityController::class)->only('index', 'show');
    Route::resource('comments', CommentsController::class);
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function() {
    Route::resource('/', AdminController::class)->only('index');
    Route::resource('import', ImportController::class);
    Route::resource('city', CityController::class)->except('show');
});
