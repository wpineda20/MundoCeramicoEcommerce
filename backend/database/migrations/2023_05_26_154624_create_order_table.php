<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();

            $table->string('typeDelivery');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('store')->onDelete('cascade');

            $table->unsignedBigInteger('localization_id');
            $table->foreign('localization_id')->references('id')->on('localization')->onDelete('cascade');

            // $table->unsignedBigInteger('state_id');
            // $table->foreign('state_id')->references('id')->on('state');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
