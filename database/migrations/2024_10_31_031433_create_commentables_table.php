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
        Schema::create('commentables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('app_user_id')->unsigned()->nullable();
            $table->text('body');
            $table->bigInteger('likes')->unsigned();
            $table->bigInteger('dislikes')->unsigned();
            $table->timestamps();

            $table->foreign('app_user_id')->references('id')->on('app_users')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentables');
    }
};
