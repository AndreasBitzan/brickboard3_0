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
        Schema::create('messageboards', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('slug');
            $table->json('description')->nullable();
            $table->integer('topics_count')->default(0);
            $table->integer('posts_count')->default(0);
            $table->unsignedBigInteger('last_topic_id')->nullable();
            $table->foreignId('messageboard_group_id')->constrained()->cascadeOnDelete();
            $table->boolean('locked')->default(false);
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messageboards');
    }
};
