Hola Javi!

Te comento el API.

Se han creado conexiones con 3 tipos diferentes de API.

1. SPOTIFY

Para esta api vas a tener que registrarte en la siguiente web "https://developer.spotify.com/".

Una vez registrado, vas a tener que crear un aplicacion y pegar el "client_id", "client_Secret" y tu nombre de usuario "user_id" en el archivo ".env".

No vas a poder hacer los POST y PUT porque se requiere de una doble verificación. Si lo intentas lo más seguro es que te de un codigo 401(Unauthorized).

>Route::get('/userPlaylist','App\Http\Controllers\SpotifyController@getUserPlaylists');
Este GET te permite obtener las PlayLists que tiene el usuario.
En el body envias un JSON como el siguiente:
{
  "user_id": "sahil.junior10"
}

>Route::get('/artist', 'App\Http\Controllers\SpotifyController@getArtistByName');
Para este envias el siguiente JSON:
{
    "name": "Central Cee"
}

>Route::get('/search', 'App\Http\Controllers\SpotifyController@searchTrack');
Para este envias el siguiente JSON:
{
    "name": "Como las Estrellas"
}

>Route::post('/playlists', 'App\Http\Controllers\SpotifyController@createPlaylist');
Este no se si seras capaz de ejecutarlo, pero te dejo el JSON:
{
  "name": "Nombre de la playlist",
  "description": "Descripción de la playlist"
}


>Route::put('/playlists/{id}', 'App\Http\Controllers\SpotifyController@updatePlaylist');
Este no se si seras capaz de ejecutarlo, pero te dejo el JSON:
{
  "name": "Nombre de la playlist editado",
  "description": "Descripción de la playlist editada"
}


>Route::get('/token', 'App\Http\Controllers\SpotifyController@getToken');
Para este no te hace falta nada, haces la petición y ya.



2. OPEN WEATHER
Esta api es facil, te dejo la APIKey puesta ya que esta no caduca. Lo unico que tienes que hacer para que funcione es hacer la petición y ya.

>Route::get('/cities', 'App\Http\Controllers\WeatherController@getCurrentWeather');
Envias este JSON con el nombre de la ciudad que quieras y ya, te saldrá a tiempo real el tiempo que hace en esa ciudad:
{
    "city": "Barcelona"
}




3. MARVEL
Esta api ya la habrás visto en una de las anteriores practicas que te he enviado.
Como no se pueden hacer POST o PUT porque es una API de marca registrada, pues solo te dejan obtener información.

Para usar esta API vas a tener que registrarte en la siguiente pagina "https://developer.marvel.com/". Una vez registrado vas a necesitar la "public_key" y la "private_key".

Vas a tener que crear otra app.

>Route::get('/characters', 'App\Http\Controllers\MarvelController@getCharacters');
Este es un GET sin más, haces la petición y ya.


>Route::get('/character', 'App\Http\Controllers\MarvelController@getCharacterByName');
Para esta petición vas a tener que enviar el siguiente JSON:
{
    "name": "Iron Man"
}

>Route::get('/comics', 'App\Http\Controllers\MarvelController@getComics');
Este es un GET sin más, haces la petición y ya.