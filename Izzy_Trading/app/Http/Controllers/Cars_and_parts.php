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
        $car->registration_number = $request->registration_number;
        $car->is_registered = $request->is_registered;
        $car->save();

    }

    public function updateCar(Request $request)
    {

        Car::find($request->id)->update([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'is_registered' => $request->is_registered
        ]);

    }

    public function deleteCar(Request $request)
    {
        Car::find($request->id)->delete();

    }
}
