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

        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->enum('availability_status', ['in_stock', 'out_of_stock'])->default('in_stock');
            $table->enum('dish_tag', ['popular', 'most_ordered', 'latest'])->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('preparation_time')->nullable();
            $table->enum('spice_level', ['mild', 'medium', 'spicy', 'extra_spicy'])->nullable();
            $table->text('ingredients')->nullable(); // Can store JSON of ingredients
            $table->integer('calories')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
