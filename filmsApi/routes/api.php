<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/films', 'App\Http\Controllers\FilmController@index');
Route::get('/films/{id}/actors', 'App\Http\Controllers\ActorFilmController@show');
Route::get('/films/{id}/critics', 'App\Http\Controllers\CriticFilmController@show');
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/critics/{id}', 'App\Http\Controllers\CriticController@destroy');
Route::get('/films/{id}/averageScore', 'App\Http\Controllers\CriticFilmController@averageScore');
Route::get('/users/{id}/preferredLanguage', 'App\Http\Controllers\UserCriticController@preferredLanguage');
//Route::get('/users', 'App\Http\Controllers\UserController@index');



Route::get('/languages', 'App\Http\Controllers\LanguageController@index');
Route::get('/languages/{id}', 'App\Http\Controllers\LanguageController@show');
Route::get('/languages/{id}/films', 'App\Http\Controllers\LanguageFilmController@index');

Route::post('/films', 'App\Http\Controllers\FilmController@store');
Route::delete('/films/{id}', 'App\Http\Controllers\FilmController@destroy');

Route::get('/avg/{id}', 'App\Http\Controllers\LanguageFilmController@avg');