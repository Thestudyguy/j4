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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointmentID')->nullable();
            $table->foreign('appointmentID')->references('id')->on('appointments')->nullOnDelete();
            $table->unsignedBigInteger('itemID')->nullable();
            $table->foreign('itemID')->references('id')->on('inventories')->nullOnDelete();
            $table->string('item');
            $table->decimal('itemPrice', 15);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
