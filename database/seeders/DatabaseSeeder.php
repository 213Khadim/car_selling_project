<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarColor;
use App\Models\CarType;
use App\Models\Company;
use App\Models\Customer;
use App\Models\ExpenseCategory;
use App\Models\Location;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@autodrive.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '+1-555-0001',
        ]);

        User::create([
            'name'     => 'John User',
            'email'    => 'user@autodrive.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'phone'    => '+1-555-0002',
        ]);

        // Companies (Car Brands)
        $companies = [
            ['name' => 'Toyota', 'country' => 'Japan'],
            ['name' => 'BMW', 'country' => 'Germany'],
            ['name' => 'Mercedes-Benz', 'country' => 'Germany'],
            ['name' => 'Audi', 'country' => 'Germany'],
            ['name' => 'Lexus', 'country' => 'Japan'],
            ['name' => 'Porsche', 'country' => 'Germany'],
            ['name' => 'Honda', 'country' => 'Japan'],
            ['name' => 'Ford', 'country' => 'USA'],
        ];
        foreach ($companies as $c) {
            Company::create($c);
        }

        // Car Types
        $types = ['Sedan', 'SUV', 'Coupe', 'Truck', 'Sports Car', 'Hatchback', 'Convertible', 'Minivan'];
        foreach ($types as $type) {
            CarType::create(['name' => $type]);
        }

        // Car Colors
        $colors = [
            ['name' => 'Black', 'hex_code' => '#000000'],
            ['name' => 'White', 'hex_code' => '#FFFFFF'],
            ['name' => 'Silver', 'hex_code' => '#C0C0C0'],
            ['name' => 'Blue', 'hex_code' => '#0000FF'],
            ['name' => 'Red', 'hex_code' => '#FF0000'],
            ['name' => 'Gray', 'hex_code' => '#808080'],
            ['name' => 'Green', 'hex_code' => '#008000'],
            ['name' => 'Gold', 'hex_code' => '#FFD700'],
        ];
        foreach ($colors as $color) {
            CarColor::create($color);
        }

        // Locations
        $locations = [
            ['name' => 'Herat Showroom', 'city' => 'Herat', 'country' => 'Afghanistan'],
            ['name' => 'Kabul Lot', 'city' => 'Kabul', 'country' => 'Afghanistan'],
            ['name' => 'Dubai Warehouse', 'city' => 'Dubai', 'country' => 'UAE'],
            ['name' => 'In Transit', 'city' => '', 'country' => ''],
        ];
        foreach ($locations as $loc) {
            Location::create($loc);
        }

        // Expense Categories
        $expCategories = ['Transport', 'Customs', 'Maintenance', 'Salaries', 'Utilities', 'Marketing', 'Other'];
        foreach ($expCategories as $cat) {
            ExpenseCategory::create(['name' => $cat]);
        }

        // Sample Cars
        $sampleCars = [
            [
                'company_id'    => 2, // BMW
                'name'          => 'M5 Competition',
                'vin'           => 'WBA5B5C55HD123456',
                'lot_number'    => 'LOT-2024-001',
                'year'          => 2024,
                'type_id'       => 1, // Sedan
                'color_id'      => 4, // Blue
                'mileage'       => '5,000 km',
                'purchase_cost' => 98000,
                'sale_price'    => 125000,
                'location_id'   => 1,
                'status'        => 'reached',
                'fuel_type'     => 'petrol',
                'transmission'  => 'automatic',
                'is_featured'   => true,
            ],
            [
                'company_id'    => 3, // Mercedes-Benz
                'name'          => 'AMG GT',
                'vin'           => 'WDD1900721A234567',
                'lot_number'    => 'LOT-2024-002',
                'year'          => 2024,
                'type_id'       => 5, // Sports Car
                'color_id'      => 1, // Black
                'mileage'       => '2,000 km',
                'purchase_cost' => 135000,
                'sale_price'    => 165000,
                'location_id'   => 3, // Dubai
                'status'        => 'on_way',
                'fuel_type'     => 'petrol',
                'transmission'  => 'automatic',
                'is_featured'   => true,
            ],
            [
                'company_id'    => 1, // Toyota
                'name'          => 'Land Cruiser 300',
                'vin'           => 'JTMHX3FJ5N4123789',
                'lot_number'    => 'LOT-2024-003',
                'year'          => 2023,
                'type_id'       => 2, // SUV
                'color_id'      => 2, // White
                'mileage'       => '12,000 km',
                'purchase_cost' => 75000,
                'sale_price'    => 95000,
                'location_id'   => 1,
                'status'        => 'reached',
                'fuel_type'     => 'diesel',
                'transmission'  => 'automatic',
                'is_featured'   => true,
            ],
            [
                'company_id'    => 4, // Audi
                'name'          => 'RS6 Avant',
                'vin'           => 'WAUZZZ4G9JN012345',
                'lot_number'    => 'LOT-2024-004',
                'year'          => 2024,
                'type_id'       => 1, // Sedan
                'color_id'      => 3, // Silver
                'mileage'       => '8,500 km',
                'purchase_cost' => 110000,
                'sale_price'    => 138000,
                'location_id'   => 2,
                'status'        => 'reached',
                'fuel_type'     => 'petrol',
                'transmission'  => 'automatic',
                'is_featured'   => false,
            ],
        ];
        foreach ($sampleCars as $car) {
            Car::create($car);
        }

        // Sample Customers
        $customers = [
            ['name' => 'Ahmad Karimi', 'email' => 'ahmad@example.com', 'phone' => '+93-70-123-4567', 'address' => 'Herat, Afghanistan'],
            ['name' => 'Mohammed Ali', 'email' => 'moh@example.com', 'phone' => '+93-79-234-5678', 'address' => 'Kabul, Afghanistan'],
            ['name' => 'Khalid Hassan', 'email' => 'khalid@example.com', 'phone' => '+971-50-345-6789', 'address' => 'Dubai, UAE'],
        ];
        foreach ($customers as $cust) {
            Customer::create($cust);
        }

        // Settings
        $settings = [
            'site_name'    => 'AutoDrive',
            'site_email'   => 'info@autodrive.com',
            'site_phone'   => '+93-70-000-0000',
            'site_address' => 'Herat, Afghanistan',
            'currency'     => 'USD',
        ];
        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
