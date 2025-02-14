<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_zones', function (Blueprint $table) {
            $table->id();
            $table->string('country'); // USA, Canada, Australia
            $table->decimal('min_weight', 8, 2); // Minimum weight range
            $table->decimal('max_weight', 8, 2)->nullable(); // NULL means unlimited weight
            $table->decimal('standard_rate', 8, 2); // Standard shipping cost
            $table->decimal('priority_rate', 8, 2); // Priority shipping cost
            $table->string('currency'); // USD, CAD, AUD
            $table->timestamps();
        });

        // Seeding default shipping rates
        DB::table('shipping_zones')->insert([
            // USA Shipping Rates (USD)
            ['country' => 'USA', 'min_weight' => 0, 'max_weight' => 1, 'standard_rate' => 5.00, 'priority_rate' => 10.00, 'currency' => 'USD'],
            ['country' => 'USA', 'min_weight' => 1, 'max_weight' => 5, 'standard_rate' => 10.00, 'priority_rate' => 20.00, 'currency' => 'USD'],
            ['country' => 'USA', 'min_weight' => 5, 'max_weight' => 10, 'standard_rate' => 15.00, 'priority_rate' => 30.00, 'currency' => 'USD'],
            ['country' => 'USA', 'min_weight' => 10, 'max_weight' => NULL, 'standard_rate' => 15.00, 'priority_rate' => 30.00, 'currency' => 'USD'],

            // Canada Shipping Rates (CAD)
            ['country' => 'Canada', 'min_weight' => 0, 'max_weight' => 1, 'standard_rate' => 6.00, 'priority_rate' => 12.00, 'currency' => 'CAD'],
            ['country' => 'Canada', 'min_weight' => 1, 'max_weight' => 5, 'standard_rate' => 12.00, 'priority_rate' => 22.00, 'currency' => 'CAD'],
            ['country' => 'Canada', 'min_weight' => 5, 'max_weight' => 10, 'standard_rate' => 18.00, 'priority_rate' => 35.00, 'currency' => 'CAD'],
            ['country' => 'Canada', 'min_weight' => 10, 'max_weight' => NULL, 'standard_rate' => 18.00, 'priority_rate' => 35.00, 'currency' => 'CAD'],

            // Australia Shipping Rates (AUD)
            ['country' => 'Australia', 'min_weight' => 0, 'max_weight' => 1, 'standard_rate' => 7.00, 'priority_rate' => 14.00, 'currency' => 'AUD'],
            ['country' => 'Australia', 'min_weight' => 1, 'max_weight' => 5, 'standard_rate' => 14.00, 'priority_rate' => 26.00, 'currency' => 'AUD'],
            ['country' => 'Australia', 'min_weight' => 5, 'max_weight' => 10, 'standard_rate' => 20.00, 'priority_rate' => 40.00, 'currency' => 'AUD'],
            ['country' => 'Australia', 'min_weight' => 10, 'max_weight' => NULL, 'standard_rate' => 20.00, 'priority_rate' => 40.00, 'currency' => 'AUD'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_zones');
    }
};
