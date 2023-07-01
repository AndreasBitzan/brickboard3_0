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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->dateTime('latest_activity_at')->nullable();
            $table->integer('posts_count')->default(0);
            $table->integer('movies_count')->default(0);
            $table->dateTime('last_seen_at')->nullable();
            $table->longText('profile_description')->nullable();
            $table->string('occupation')->nullable();
            $table->string('location')->nullable();
            $table->string('camera')->nullable();
            $table->string('cutting_program')->nullable();
            $table->string('sound')->nullable();
            $table->string('lighting')->nullable();
            $table->string('website_url', 2048)->nullable();
            $table->string('youtube_url', 2048)->nullable();
            $table->string('facebook_url', 2048)->nullable();
            $table->string('twitter_url', 2048)->nullable();
            $table->string('tiktok_url', 2048)->nullable();
            $table->string('instagram_url', 2048)->nullable();
            $table->text('interests')->nullable();
            $table->integer('received_likes_movies')->default(0);
            $table->string('banner_url', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
