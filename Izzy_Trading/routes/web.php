<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('index');
});

Route::get('cars-and-parts/cars',[\App\Http\Controllers\Cars_and_parts::class,'getCars']);
Route::post('cars-and-parts/cars',[\App\Http\Controllers\Cars_and_parts::class,'saveCar']);
Route::post('cars-and-parts/update',[\App\Http\Controllers\Cars_and_parts::class,'updateCar']);
Route::delete('cars-and-parts/delete/{id}',[\App\Http\Controllers\Cars_and_parts::class,'deleteCar']);
