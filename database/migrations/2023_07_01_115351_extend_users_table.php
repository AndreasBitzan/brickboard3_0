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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('failed_attempts')->default(0)->after('profile_photo_path');
            $table->dateTime('locked_at')->nullable()->after('failed_attempts');
            $table->unsignedBigInteger('main_badge')->nullable()->after('locked_at');
            $table->integer('sign_in_count')->default(0)->after('main_badge');
            $table->dateTime('current_sign_in_at')->nullable()->after('sign_in_count');
            $table->dateTime('last_sign_in_at')->nullable()->after('current_sign_in_at');
            $table->string('current_sign_in_ip')->nullable()->after('last_sign_in_at');
            $table->string('last_sign_in_ip')->nullable()->after('current_sign_in_ip');
            $table->string('slug')->unique()->after('name');
            $table->boolean('activated')->default(true)->after('last_sign_in_ip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('failed_attempts');
            $table->dropColumn('locked_at');
            $table->dropColumn('main_badge');
            $table->dropColumn('sign_in_count');
            $table->dropColumn('current_sign_in_at');
            $table->dropColumn('last_sign_in_at');
            $table->dropColumn('current_sign_in_ip');
            $table->dropColumn('last_sign_in_ip');
            $table->dropColumn('slug');
            $table->dropColumn('activated');
        });
    }
};
