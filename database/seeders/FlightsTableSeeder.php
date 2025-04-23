<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $flights = [
            [
                "airline" => "Jet Airways",
                "airline_code" => "9W",
                "flight_number" => 186,
                "origin" => "PNQ",
                "available_seats" => 116,
                "destination" => "DEL",
                "price" => 6733,
                "departure" => "2013-01-01 10:59:00",
                "arrival" => "2013-01-01 13:32:00",
                "duration" => "2h 33m",
                "operational_days" => [0, 2]
            ],
            [
                "airline" => "Jet Airways",
                "airline_code" => "9W",
                "flight_number" => 251,
                "origin" => "PNQ",
                "available_seats" => 53,
                "destination" => "DEL",
                "price" => 8713,
                "departure" => "2013-01-01T08:17:00.000Z",
                "arrival" => "2013-01-01T10:54:00.000Z",
                "duration" => "2h 37m",
                "operational_days" => [7]
            ],
            [
                "airline" => "Indigo",
                "airline_code" => "6E",
                "flight_number" => 224,
                "origin" => "PNQ",
                "available_seats" => 87,
                "destination" => "DEL",
                "price" => 5996,
                "departure" => "2013-01-01T03:09:00.000Z",
                "arrival" => "2013-01-01T05:25:00.000Z",
                "duration" => "2h 16m",
                "operational_days" => [7]
            ],
            [
                "airline" => "Air India",
                "airline_code" => "AI",
                "flight_number" => 192,
                "origin" => "PNQ",
                "available_seats" => 28,
                "destination" => "DEL",
                "price" => 3652,
                "departure" => "2013-01-01T09:30:00.000Z",
                "arrival" => "2013-01-01T11:31:00.000Z",
                "duration" => "2h 1m",
                "operational_days" => [7]
            ],
            [
                "airline" => "Spice Jet",
                "airline_code" => "SG",
                "flight_number" => 241,
                "origin" => "PNQ",
                "available_seats" => 29,
                "destination" => "DEL",
                "price" => 7413,
                "departure" => "2013-01-01T13:55:00.000Z",
                "arrival" => "2013-01-01T15:43:00.000Z",
                "duration" => "1h 48m",
                "operational_days" => [7]
            ],
            [
                "airline" => "Indigo",
                "airline_code" => "6E",
                "flight_number" => 240,
                "origin" => "PNQ",
                "available_seats" => 10,
                "destination" => "DEL",
                "price" => 4843,
                "departure" => "2013-01-01T05:47:00.000Z",
                "arrival" => "2013-01-01T07:35:00.000Z",
                "duration" => "1h 48m",
                "operational_days" => [7]
            ],
            [
                "airline" => "Air India",
                "airline_code" => "AI",
                "flight_number" => 167,
                "origin" => "PNQ",
                "available_seats" => 126,
                "destination" => "DEL",
                "price" => 2930,
                "departure" => "2013-01-01T12:10:00.000Z",
                "arrival" => "2013-01-01T14:00:00.000Z",
                "duration" => "1h 50m",
                "operational_days" => [1,2]
            ],
            [
                "airline" => "Spice Jet",
                "airline_code" => "SG",
                "flight_number" => 254,
                "origin" => "PNQ",
                "available_seats" => 33,
                "destination" => "DEL",
                "price" => 4191,
                "departure" => "2013-01-01T10:01:00.000Z",
                "arrival" => "2013-01-01T12:35:00.000Z",
                "duration" => "2h 34m",
                "operational_days" => [7]
            ],
            [
                "airline" => "Jet Airways",
                "airline_code" => "9W",
                "flight_number" => 144,
                "origin" => "PNQ",
                "available_seats" => 45,
                "destination" => "DEL",
                "price" => 5788,
                "departure" => "2013-01-01T06:09:00.000Z",
                "arrival" => "2013-01-01T09:06:00.000Z",
                "duration" => "2h 57m",
                "operational_days" => [3,4]
            ],
            [
                "airline" => "Air India",
                "airline_code" => "AI",
                "flight_number" => 193,
                "origin" => "PNQ",
                "available_seats" => 71,
                "destination" => "DEL",
                "price" => 7460,
                "departure" => "2013-01-01T11:03:00.000Z",
                "arrival" => "2013-01-01T12:57:00.000Z",
                "duration" => "1h 54m",
                "operational_days" => [6,5]
            ]


        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }

}
