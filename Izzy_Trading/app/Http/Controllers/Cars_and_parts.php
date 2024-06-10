<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\Request;

class Cars_and_parts extends Controller
{
    public function getCars()
    {

        $cars = Car::all();
        return $cars;

    }

    public function getParts()
    {

        $parts = Part::all();
        return $parts;
    }

    public function saveCar(Request $request)
    {

        $car = new Car();
        $car->name = $request->name;
        $car->registration_number = $request->registration_number;
        $car->is_registered = $request->is_registered;
        $car->save();

    }

    public function savePart(Request $request){

        $part=new Part();
        $part->name=$request->name;
        $part->serialnumber=$request->serial_number;
        $car=Car::where('name',$request->car)->first();
        $part->car_id=$car->id;
        $part->save();

    }

    public function updateCar(Request $request)
    {

        Car::find($request->id)->update([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'is_registered' => $request->is_registered
        ]);

    }

    public function updatePart(Request $request)
    {

        $car=Car::where('name',$request->car_id)->first();
        $carId=$car->id;

        Part::find($request->id)->update([
            'name' => $request->name,
            'serialnumber' => $request->serialnumber,
            'car_id' => $carId
        ]);

    }


    public function deleteCar(Request $request)
    {
        Car::find($request->id)->delete();

    }

    public function deletePart(Request $request)
    {
        Part::find($request->id)->delete();

    }
}
