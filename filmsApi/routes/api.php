<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/films', 'App\Http\Controllers\FilmController@index');
Route::get('/films/{id}', 'App\Http\Controllers\FilmController@show');

Route::get('/languages', 'App\Http\Controllers\LanguageController@index');
Route::get('/languages/{id}', 'App\Http\Controllers\LanguageController@show');
Route::get('/languages/{id}/films', 'App\Http\Controllers\LanguageFilmController@index');

Route::post('/films', 'App\Http\Controllers\FilmController@store');
Route::delete('/films/{id}', 'App\Http\Controllers\FilmController@destroy');

Route::get('/avg/{id}', 'App\Http\Controllers\LanguageFilmController@avg');