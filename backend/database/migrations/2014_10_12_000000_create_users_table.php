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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_type')->nullable()->comment('1 = Contribuyente, 0 = No contribuyente');
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('giro')->nullable();
            $table->string('address')->nullable();
            $table->string('department')->nullable();
            $table->string('municipality')->nullable();
            $table->string('nit')->nullable();
            $table->string('iva')->nullable();
            $table->string('dui')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_call')->nullable();
            $table->string('phone_whatsapp')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
