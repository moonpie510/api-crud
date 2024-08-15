<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Guest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $countries = json_decode(file_get_contents(__DIR__ .'/countries.json'));
        foreach ($countries as $key => $country) {
            Country::create([
                'code' => $key,
                'name' => $country,
            ]);
        }

        $guestsData = [
            [
                'name' => 'pupa',
                'surname' => 'one',
                'phone' => '+78005553535',
                'email' => 'pupa@mail.ru',
                'country_id' => '26'
            ],
            [
                'name' => 'lupa',
                'surname' => 'two',
                'phone' => '+79531771523',
                'email' => 'lupa@mail.ru',
                'country_id' => '26'
            ]
        ];

        foreach ($guestsData as $guestData) {
            Guest::create($guestData);
        }

    }
}
