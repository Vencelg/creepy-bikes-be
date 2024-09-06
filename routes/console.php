<?php

use App\Models\Place;

Schedule::call(function () {
    Log::debug('Updating place data');
    DB::table('places')->delete();

    $places = Http::get('https://nextbike.net/maps/nextbike-official.json?city=703')->json()['countries'][0]['cities'][0]['places'];
    foreach ($places as $place) {
        Place::factory()->create([
            'id' => $place['uid'],
            'name' => $place['name'],
            'lat' => $place['lat'],
            'lng' => $place['lng'],
            'bike_count' => count($place['bike_list'])
        ]);
    }
})->everyTenMinutes();
