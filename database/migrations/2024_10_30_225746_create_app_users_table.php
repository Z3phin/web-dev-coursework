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
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('username')->unique();
            $table->string('pronouns');
            $table->tinyText('status');
            $table->text('About');
            $table->bigInteger('xp_count')->unsigned();
            $table->enum('level', [
                'gamer',
                'student',
                'trainee',
                'junior',
                'developer',
                'senior',
                'leader'
            ]);
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};
