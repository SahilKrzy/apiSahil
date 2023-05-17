<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openweathermap.org/data/2.5/',
            'query' => [
                'appid' => env('OPENWEATHER_API_KEY')
            ]
        ]);
    }

    public function getCurrentWeather(Request $request)
    {
        $apiKey = env('OPENWEATHER_API_KEY'); // Reemplaza con tu propia clave de API de OpenWeatherMap
        $city = $request->input('city');
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        return $response->json();
    }

    public function getForecast($city)
    {
        $response = $this->client->request('GET', 'forecast', [
            'query' => [
                'q' => $city,
                'units' => 'metric'
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function createCity(Request $request)
    {
        $name = $request->input('name');
        $country = $request->input('country');

        $response = $this->client->request('POST', 'weather', [
            'query' => [
                'q' => $name . ',' . $country,
                'units' => 'metric'
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function updateCity(Request $request, $city)
    {
        $name = $request->input('name');
        $country = $request->input('country');

        $response = $this->client->request('PUT', 'weather', [
            'query' => [
                'q' => $city,
                'name' => $name,
                'country' => $country,
                'units' => 'metric'
            ]
        ]);

        return $response->getBody()->getContents();
    }
}