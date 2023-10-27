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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name')->nullable();
            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->references('id')->on('room_types');
            $table->string('total_adult')->nullable();
            $table->string('total_child')->nullable();
            $table->string('room_capacity')->nullable();
            $table->string('photo')->nullable();
            $table->decimal('price', 6, 2)->nullable();
            $table->string('size')->nullable();
            $table->string('view')->nullable();
            $table->string('bed_style')->nullable();
            $table->integer('discount')->default(0);
            $table->string('room_short_desc')->nullable();
            $table->text('room_description')->nullable();
            $table->enum('room_availability', ['available', 'unavailable'])->default('available');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
