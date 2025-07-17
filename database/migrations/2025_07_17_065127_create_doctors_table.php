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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('ProfessionalTitle')->nullable(); // Dr., Atty., etc.
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('MiddleName')->nullable();
            $table->string('Suffix')->nullable(); // Jr., Sr., III, etc.
            $table->string('MDLink')->nullable(); // For doctor's profile or calendar link
            $table->string('image_path')->nullable();
            $table->boolean('isVisible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
