<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'name', 'vin', 'lot_number', 'year', 'type_id',
        'color_id', 'mileage', 'purchase_cost', 'sale_price', 'location_id',
        'status', 'fuel_type', 'transmission', 'notes', 'is_featured', 'image',
    ];

    protected $casts = [
        'purchase_cost' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function type()
    {
        return $this->belongsTo(CarType::class, 'type_id');
    }

    public function color()
    {
        return $this->belongsTo(CarColor::class, 'color_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'new_purchased' => 'badge-primary',
            'on_way'        => 'badge-info',
            'reached'       => 'badge-success',
            'unpaid'        => 'badge-danger',
            'sold'          => 'badge-secondary',
            'unsold'        => 'badge-warning',
            default         => 'badge-secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new_purchased' => 'New Purchased',
            'on_way'        => 'On Way',
            'reached'       => 'Reached',
            'unpaid'        => 'Unpaid',
            'sold'          => 'Sold',
            'unsold'        => 'Unsold',
            default         => ucfirst($this->status),
        };
    }
}
