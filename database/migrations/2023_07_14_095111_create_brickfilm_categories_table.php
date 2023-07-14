<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brickfilm_categories', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->integer('position')->default(100);
            $table->boolean('locked')->default(false);
            $table->boolean('visible')->default(true);
            $table->boolean('assignable')->default(true);
            $table->boolean('main_category')->default(true);
            $table->unsignedBigInteger('badge_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brickfilm_categories');
    }
};
