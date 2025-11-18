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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patient_info')->nullOnDelete();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->nullOnDelete();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('sub_services')->nullOnDelete();
            $table->string('status')->default('Pending');
            $table->date('date');
            $table->string('time');
            $table->date('resched_date')->nullable();
            $table->string('resched_time')->nullable();
            $table->boolean('is_walk_in')->default(false);
            $table->string('created_by')->nullable();
            $table->decimal('amount_paid', 15)->nullable();
            $table->unsignedBigInteger('mark_by')->nullable();
            $table->foreign('mark_by')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
