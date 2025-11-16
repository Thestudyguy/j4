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
        Schema::create('dentist_off_scheds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dentist_id')->nullable();
            $table->foreign('dentist_id')->references('id')->on('doctors')->nullOnDelete();
            $table->date('date');
            $table->string('time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentist_off_scheds');
    }
};
