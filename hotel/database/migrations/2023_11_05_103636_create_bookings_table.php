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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id');
            $table->integer('user_id')->nullable();
            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->string('total_adult')->nullable();
            $table->string('total_child')->nullable();

            $table->integer('total_night')->nullable();
            $table->decimal('total_price', 6, 2)->nullable();

            $table->string('payment_method')->nullable();
            $table->string('transation_id')->nullable();
            $table->string('payment_status')->nullable();

            $table->string('name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('town')->nullable();
            $table->string('post_code')->nullable();
            $table->string('address')->nullable();

            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
