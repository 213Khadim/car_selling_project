<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon'];

    public function cars()
    {
        return $this->hasMany(Car::class, 'type_id');
    }
}
