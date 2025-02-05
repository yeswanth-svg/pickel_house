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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dish_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_amount', 8, 3);
            $table->unsignedBigInteger('applied_coupon_id');
            $table->decimal('discount_amount', 8, 3);
            $table->enum('status', ['Cart', 'Pending Payment', 'Processing', 'Completed',]);
            $table->enum('payment_status', ['COD', 'Online Payment'])->nullable();

            $table->timestamps();

            $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
