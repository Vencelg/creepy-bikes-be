<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Http;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
    }
}
