<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patient_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users')->nullOnDelete();
            // Required fields
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('MiddleName')->nullable();
            $table->date('BirthDate')->nullable();
            $table->string('Gender')->nullable();
            $table->integer('Age')->nullable();
            $table->string('Religion')->nullable();
            $table->string('Nationality')->nullable();
            $table->string('Address')->nullable();
            $table->string('HomeNo')->nullable();
            $table->string('Occupation')->nullable();
            $table->date('EffectiveDate')->nullable();
            $table->string('Email')->nullable();
            $table->string('MobileNo')->nullable();
            $table->string('ReasonForVisit')->nullable();

            // Optional fields
            $table->string('NickName')->nullable();
            $table->string('OfficeNo')->nullable();
            $table->string('FaxNo')->nullable();
            $table->string('Guardian')->nullable();
            $table->string('GuardianOccupation')->nullable();
            $table->string('Referal')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
