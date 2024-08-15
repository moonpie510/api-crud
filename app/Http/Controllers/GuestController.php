<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guest\StoreRequest;
use App\Http\Requests\Guest\UpdateRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\GuestResource;
use App\Models\Country;
use App\Models\Guest;
use App\Service\GuestService;
use Illuminate\Http\Request;
use Propaganistas\LaravelPhone\PhoneNumber;

class GuestController extends Controller
{
    public function getAllCountries()
    {
        $countries = Country::all();
        return CountryResource::collection($countries);
    }

    public function getCountry(Country $country)
    {
        return new CountryResource($country);
    }

    public function index()
    {
        $guests = Guest::all();
        return GuestResource::collection($guests);

    }

    public function show(Guest $guest)
    {
        return new GuestResource($guest);
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        GuestService::store($data);

        return response()->json([
            'message' => 'Пользователь создан'
        ]);
    }

    public function update(Guest $guest, UpdateRequest $request)
    {
        $data = $request->validated();
        $guest->update($data);
        return response()->json([
            'message' => 'Пользователь обновлен'
        ]);
    }

    public function delete(Guest $guest)
    {
        $guest->delete();
        return response()->json([
            'message' => 'Пользователь удален'
        ]);
    }
    }
