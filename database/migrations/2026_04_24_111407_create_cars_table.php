<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name');
            $table->string('vin', 50)->nullable()->unique();
            $table->string('lot_number')->nullable();
            $table->year('year');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->string('mileage')->nullable();
            $table->decimal('purchase_cost', 15, 2)->default(0);
            $table->decimal('sale_price', 15, 2)->default(0);
            $table->unsignedBigInteger('location_id')->nullable();
            $table->enum('status', ['new_purchased', 'on_way', 'reached', 'unpaid', 'sold', 'unsold'])->default('new_purchased');
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
