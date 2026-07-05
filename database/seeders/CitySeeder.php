<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
    'Cairo',
    'Giza',
    'Alexandria',
    'Shubra El Kheima',
    'Port Said',
    'Suez',
    'Luxor',
    'Aswan',
    'Mansoura',
    'Tanta',
    'Zagazig',
    'Ismailia',
    'Fayoum',
    'Beni Suef',
    'Minya',
    'Assiut',
    'Sohag',
    'Qena',
    'Damietta',
    'Kafr El Sheikh',
    'Damanhur',
    'Banha',
    'Arish',
    'Hurghada',
    'Marsa Matruh',
    'Sharm El Sheikh',
    'El Tor',
    'New Valley',
    'Kharga',
    'Ras Gharib',
    'Safaga',
    'Qus',
    'Edfu',
    'Kom Ombo',
    'Abu Simbel',
    'Rosetta',
    'Desouk',
    'Belbeis',
    '10th of Ramadan',
    'Obour',
    'New Cairo',
    '6th of October',
    'Sheikh Zayed',
    'New Administrative Capital',
    'Sadat City',
    'Badr City',
    'New Damietta',
    'Borg El Arab',
    'El Mahalla El Kubra',
    'Kafr El Dawwar',
    'Other',
];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}
