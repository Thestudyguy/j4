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
            $table->foreign('patient_id')->references('id')->on('patients')->nullOnDelete();
            $table->string('previous_dentist')->nullable();
            $table->date('last_visit')->nullable();
            
            $table->string('physician_name')->nullable();
            $table->string('physician_specialty')->nullable();
            $table->string('physician_office_address')->nullable();
            $table->string('physician_office_no')->nullable();

            $table->boolean('good_health')->nullable();
            $table->boolean('uses_drugs')->nullable();
            $table->boolean('under_medical_care')->nullable();
            $table->text('current_medical_condition')->nullable();

            $table->boolean('pregnant')->nullable();
            $table->boolean('hospitalized')->nullable();
            $table->text('hospitalization_details')->nullable();
            $table->boolean('taking_birth_control')->nullable();
            $table->boolean('taking_medications')->nullable();
            $table->text('medications_details')->nullable();
            $table->boolean('using_tobacco')->nullable();
            $table->boolean('nursing')->nullable();

            // Allergies
            $table->boolean('allergy_anesthetic')->nullable();
            $table->boolean('allergy_sulfa')->nullable();
            $table->boolean('allergy_aspirin')->nullable();
            $table->boolean('allergy_latex')->nullable();
            $table->boolean('allergy_penicillin')->nullable();
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

