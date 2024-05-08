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
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->longText('symptoms');
            $table->longText('durations');
            $table->text('treatment');
            $table->text('medication');
            $table->text('medical_history');
            $table->text('surgical_history');
            $table->text('food');
            $table->text('drugs');
            $table->text('plaster');
            $table->text('family_history');
            $table->enum('consanguineous_marriage', ['Yes', 'No']);
            $table->text('occupation');
            $table->decimal('monthly_income', 10, 2);
            $table->text('nearest_hospital');
            $table->text('water_source');
            $table->text('general_sign');
            $table->text('abdominal');
            $table->text('cardiovascular_system');
            $table->text('respiratory_system');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->decimal('bmi', 5, 2);
            $table->decimal('temperature', 5, 2);
            $table->text('diagnosis');
            $table->longText('drug_name');
            $table->longText('dose');
            $table->longText('route');
            $table->longText('frequency');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
