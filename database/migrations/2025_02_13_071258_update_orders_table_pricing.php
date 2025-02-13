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
            $table->decimal('original_price', 10, 2)->after('quantity_id'); // Price before admin discount
            $table->decimal('discount_price', 10, 2)->after('original_price'); // Admin-set discounted price
            $table->renameColumn('discount_amount', 'coupon_discount'); // Rename for clarity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['original_price', 'discount_price']); // Remove added columns
            $table->renameColumn('coupon_discount', 'discount_amount'); // Revert column name
        });
    }
};
