<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarColor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hex_code'];

    public function cars()
    {
        return $this->hasMany(Car::class, 'color_id');
    }
}
