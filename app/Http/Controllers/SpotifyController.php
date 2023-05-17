<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SpotifyController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.spotify.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('SPOTIFY_ACCESS_TOKEN')
            ]
        ]);
    }

    public function getToken()
    {
        $apiId = env('CLIENT_ID_SP');
        $apiSecret = env('CLIENT_SECRET_SP');

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $apiId,
            'client_secret' => $apiSecret,
        ]);

        return $response->json();
    }


    public function getUserPlaylists(Request $request)
    {
        $accessToken = $request->header('Authorization'); // Reemplaza con tu token de acceso válido de Spotify
        $userId = $request->input('user_id');

        $response = Http::withHeaders([
            'Authorization' => $accessToken,
        ])->get("https://api.spotify.com/v1/users/{$userId}/playlists");

        return $response->json();
    }

    public function getArtistByName(Request $request)
    {
        $accessToken = $request->header('Authorization'); // Reemplaza con tu token de acceso válido de Spotify
        $name = $request->input('name');

        $response = Http::withHeaders([
            'Authorization' => $accessToken,
        ])->get('https://api.spotify.com/v1/search', [
            'q' => $name,
            'type' => 'artist',
            'limit' => 1
        ]);

        return $response->json();
    }

    public function searchTrack(Request $request)
    {
        $accessToken = $request->header('Authorization'); // Reemplaza con tu token de acceso válido de Spotify
        $name = $request->input('name');

        $response = Http::withHeaders([
            'Authorization' => $accessToken,
        ])->get('https://api.spotify.com/v1/search', [
            'q' => $name,
            'type' => 'track',
            'limit' => 50
        ]);

        return $response->json();
    }

    public function createPlaylist(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $accessToken = $request->header('Authorization');
        $apiId = env('USER_ID');

        $response = Http::withHeaders([
            'Authorization' => $accessToken,
            'Content-Type' => 'application/json',
        ])->post('https://api.spotify.com/v1/users/' . $apiId . '/playlists', [
            'name' => $name,
            'description' => $description,
        ]);

        return $response->json();
    }


    public function updatePlaylist(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $response = $this->client->request('PUT', 'playlists/' . $id, [
            'json' => [
                'name' => $name,
                'description' => $description
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
