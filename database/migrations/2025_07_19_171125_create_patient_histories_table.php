<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientHistoriesTable  extends Migration
{
    public function up()
    {
        Schema::create('patient_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users')->nullOnDelete();
            $table->string('previous_dentist')->nullable();
            $table->date('last_visit')->nullable();
            
            $table->string('physician_name')->nullable();
            $table->string('physician_specialty')->nullable();
            $table->string('physician_office_address')->nullable();
            $table->string('physician_office_no')->nullable();

            $table->string('good_health')->nullable();
            $table->string('uses_drugs')->nullable();
            $table->string('under_medical_care')->nullable();
            $table->string('medical_condition_text')->nullable();

            $table->string('pregnant')->nullable();
            $table->string('hospitalized')->nullable();
            $table->text('hospitalization_details')->nullable();
            $table->string('taking_birth_control')->nullable();
            $table->string('taking_medications')->nullable();
            $table->string('medications_details')->nullable();
            $table->string('using_tobacco')->nullable();
            $table->string('nursing')->nullable();

            // Allergies
            $table->string('allergy')->nullable();
            $table->text('allergy_others')->nullable();

            // Other conditions (JSON or individual columns)
            // $table->json('known_conditions')->nullable(); // store as checkbox array <- chatgpt
            $table->json('known_conditions')->nullable();

            $table->string('blood_type')->nullable();
            $table->string('blood_pressure')->nullable();

            $table->timestamps();

            // Optional: Foreign key constraint
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient_history');
    }
}

