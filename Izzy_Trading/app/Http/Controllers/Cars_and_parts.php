<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class Cars_and_parts extends Controller
{
    public function getCars()
    {

        $cars = Car::all();

        return $cars;

    }

    public function saveCar(Request $request)
    {
        $car = new Car();
        $car->name = $request->name;
        $car->registration_number = $request->registrtion_number;
        $car->is_registered = $request->is_registered;


    }
}
