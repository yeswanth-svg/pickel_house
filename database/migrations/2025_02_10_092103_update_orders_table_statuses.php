<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Remove old columns
            $table->dropColumn(['status', 'payment_status']);

            // Add new columns with better naming
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
                'returned'
            ])->default('in_cart')->after('id');

            $table->enum('payment_state', [
                'pending',
                'failed',
                'paid',
                'refunded'
            ])->default('pending')->after('order_stage');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Rollback changes
            $table->dropColumn(['order_stage', 'payment_state']);
            $table->string('status')->nullable()->after('id');
            $table->string('payment_status')->nullable()->after('status');
        });
    }
};
