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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('last_user_id')->nullable()->constrained(table: 'users', indexName: 'topics_last_user_id')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('messageboard_id')->constrained()->cascadeOnDelete();
            $table->integer('posts_count')->default(0);
            $table->boolean('sticky')->default(false);
            $table->foreignId('moderation_state_id')->nullable()->default(1)->constrained()->nullOnDelete();
            $table->dateTime('last_post_at')->nullable();
            $table->foreignId('topic_type_id')->default(1)->constrained()->cascadeOnDelete();
            $table->string('video_url')->nullable();
            $table->integer('view_count')->default(0);
            $table->dateTime('movie_created_at')->nullable();
            $table->string('category')->nullable();
            $table->integer('likes_count')->default(0);
            $table->boolean('includes_peter')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
