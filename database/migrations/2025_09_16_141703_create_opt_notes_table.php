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
        Schema::create('opt_notes', function (Blueprint $table) {
            $table->id();
            //temp table
            $table->unsignedBigInteger('appointment')->nullable();
            $table->foreign('appointment')->references('id')->on('appointments')->nullOnDelete();
            $table->unsignedBigInteger('dentist')->nullable();
            $table->foreign('dentist')->references('id')->on('doctors')->nullOnDelete();
            $table->date('Date')->nullable();
            $table->string('Tooth')->nullable();
            $table->string('Procedure')->nullable();
            $table->decimal('AmountCharge', 15)->nullable();
            $table->decimal('AmountPaid', 15)->nullable();
            $table->decimal('Balance', 15)->nullable();
            $table->string('PostOpNotes')->nullable();
            $table->string('ImportantNotes')->nullable();
            $table->boolean('isVisible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opt_notes');
    }
};
