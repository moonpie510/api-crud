<?php

namespace App\Service;

use App\Models\Country;
use App\Models\Guest;
use Propaganistas\LaravelPhone\PhoneNumber;

class GuestService
{
    public static function store($data)
    {
        if (!isset($data['country_id'])) {
            $phone = new PhoneNumber($data['phone']);
            $countryCode = $phone->getCountry();
            $data['country_id'] = Country::where('code', $countryCode)->first()->id;
        }

        Guest::create($data);
    }
}
