<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{

    protected $fillable = ['name', 'car_id','serial_number'];
    use HasFactory;

    public function parts(): HasMany
    {

        return $this->hasMany(Part::class);
    }


}
