<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_followers', function (Blueprint $table) {
            $table->primary(['app_user_id', 'follower_id']);
            $table->foreignId('app_user_id');
            $table->foreignId('follower_id');
            
            $table->foreign('app_user_id')->references('id')->on('app_users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('follower_id')->references('id')->on('app_users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_followers');
    }
};
