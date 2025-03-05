<?php

use Illuminate\Support\Facades\Route;

Route::get('/films', 'App\Http\Controllers\FilmController@index');
Route::get('/films/{id}/actors', 'App\Http\Controllers\ActorFilmController@show');
Route::get('/films/{id}/critics', 'App\Http\Controllers\CriticFilmController@show');
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/critics/{id}', 'App\Http\Controllers\CriticController@destroy');
Route::get('/films/{id}/averageScore', 'App\Http\Controllers\CriticFilmController@averageScore');
Route::get('/users/{id}/preferredLanguage', 'App\Http\Controllers\UserCriticLanguageController@preferredLanguage');
Route::get('/films/search', 'App\Http\Controllers\FilmController@search');