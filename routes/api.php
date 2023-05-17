<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\WeatherController;

Route::prefix('v1')->group(function () {

    // Spotify API routes
    Route::prefix('spotify')->group(function () {
        Route::get('/userPlaylist', 'App\Http\Controllers\SpotifyController@getUserPlaylists');
        Route::get('/artist', 'App\Http\Controllers\SpotifyController@getArtistByName');
        Route::get('/search', 'App\Http\Controllers\SpotifyController@searchTrack');
        Route::post('/playlists', 'App\Http\Controllers\SpotifyController@createPlaylist');
        Route::put('/playlists/{id}', 'App\Http\Controllers\SpotifyController@updatePlaylist');
        Route::get('/token', 'App\Http\Controllers\SpotifyController@getToken');
    });

    // OpenWeather API routes
    Route::prefix('openweather')->group(function () {
        Route::get('/cities', 'App\Http\Controllers\WeatherController@getCurrentWeather');
    });

    // Marvel API routes
    Route::prefix('marvel')->group(function () {
        Route::get('/characters', 'App\Http\Controllers\MarvelController@getCharacters');
        Route::get('/character', 'App\Http\Controllers\MarvelController@getCharacterByName');
        Route::get('/comics', 'App\Http\Controllers\MarvelController@getComics');
    });
});
