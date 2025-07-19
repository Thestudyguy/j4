<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            
            // Required fields
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('MiddleName');
            $table->date('BirthDate');
            $table->string('Gender');
            $table->integer('Age');
            $table->string('Religion');
            $table->string('Nationality');
            $table->string('Address');
            $table->string('HomeNo');
            $table->string('Occupation');
            $table->date('EffectiveDate');
            $table->string('Email');
            $table->string('MobileNo');
            $table->string('ReasonForVisit');

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
