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
        Schema::table('orders', function (Blueprint $table) {
            // Modify order_stage to include "removed_from_cart"
            $table->enum('order_stage', [
                'in_cart',
                'confirmed',
                'processing',
                'packing',
                'shipped',
                'out_for_delivery',
                'delivered',
                'completed',
                'cancelled',
                'returned',
                'removed_from_cart'
            ])->default('in_cart')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
