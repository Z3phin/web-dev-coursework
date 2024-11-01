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
        Schema::create('forum_members', function (Blueprint $table) {
            $table->primary(['forum_id', 'app_user_id']);
            $table->foreignId('forum_id');
            $table->foreignId('app_user_id');
            $table->dateTime('joined_at');

            $table->foreign('forum_id')->references('id')->on('forums')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('app_user_id')->references('id')->on('app_users')
                ->onUpdate('cascade')->onDelete('cascade');
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
