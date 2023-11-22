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
        Schema::create('order_state_detail', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('order');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('state');

            $table->boolean('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_state_detail');
    }
};
