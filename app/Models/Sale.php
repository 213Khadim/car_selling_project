<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'customer_id', 'user_id', 'sale_price', 'sale_date', 'payment_status', 'notes'];

    protected $casts = ['sale_price' => 'decimal:2', 'sale_date' => 'date'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(CustomerPayment::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
