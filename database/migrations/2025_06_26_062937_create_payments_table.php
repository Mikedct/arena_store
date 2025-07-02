<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id('paymentID');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('game_id');
        $table->string('paymentMethod');
        $table->string('paymentStatus');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
