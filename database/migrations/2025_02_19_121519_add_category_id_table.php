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
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('user_id'); // Nullable to avoid issues
            }
        });

        // Ensure category_id has valid values before adding foreign key
        DB::statement('UPDATE tickets SET category_id = 1 WHERE category_id IS NULL'); // Replace 1 with a valid ID

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('ticket_categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
};
