<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarvelController extends Controller
{
    public function getCharacters()
    {
        $publicKey = env('PUBLIC_KEY_MARVEL'); // Reemplaza con tu clave pública de Marvel
        $privateKey = env('PRIVATE_KEY_MARVEL'); // Reemplaza con tu clave privada de Marvel

        $ts = time();
        $hash = md5($ts . $privateKey . $publicKey);

        $response = Http::get('https://gateway.marvel.com/v1/public/characters', [
            'apikey' => $publicKey,
            'ts' => $ts,
            'hash' => $hash
        ]);

        return $response->json();
    }

    public function getCharacterByName(Request $request)
    {
        $publicKey = env('PUBLIC_KEY_MARVEL'); // Reemplaza con tu clave pública de Marvel
        $privateKey = env('PRIVATE_KEY_MARVEL'); // Reemplaza con tu clave privada de Marvel
        $name = $request->input('name');
        $ts = time();
        $hash = md5($ts . $privateKey . $publicKey);

        $response = Http::get('https://gateway.marvel.com/v1/public/characters', [
            'apikey' => $publicKey,
            'ts' => $ts,
            'hash' => $hash,
            'name' => $name
        ]);

        return $response->json();
    }


    public function getComics()
    {
        $publicKey = env('PUBLIC_KEY_MARVEL'); // Reemplaza con tu clave pública de Marvel
        $privateKey = env('PRIVATE_KEY_MARVEL'); // Reemplaza con tu clave privada de Marvel

        $ts = time();
        $hash = md5($ts . $privateKey . $publicKey);

        $response = Http::get('https://gateway.marvel.com/v1/public/comics', [
            'apikey' => $publicKey,
            'ts' => $ts,
            'hash' => $hash
        ]);

        return $response->json();
    }
}
