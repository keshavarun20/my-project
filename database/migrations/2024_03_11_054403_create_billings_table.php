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
            $table->foreignId('patient_id')->nullable();
            $table->string('nic');
            $table->date('date');
            $table->string('patient_name');
            $table->string('contact_number');
            $table->text('description');
            $table->decimal('rate');
            $table->decimal('qty');
            $table->decimal('subtotal');
            $table->string('payment_method');
            $table->string('cheque_no')->nullable();
            $table->string('reference_no')->nullable();
            $table->decimal('total');
            $table->decimal('discount_percent');
            $table->decimal('discount');
            $table->decimal('tax_percent');
            $table->decimal('tax');
            $table->decimal('payable');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
