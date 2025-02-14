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
            // Add 'type_of_shipping' after 'selected_address'
            $table->string('type_of_shipping')->after('selected_address')->nullable();

            // Move 'cart_quantity' after 'quantity_id' (only possible by dropping & re-adding)
            $table->integer('cart_quantity')->after('quantity_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Remove 'type_of_shipping' column
            $table->dropColumn('type_of_shipping');

            // You cannot directly move a column back, so you'll need a separate migration
        });
    }
};
