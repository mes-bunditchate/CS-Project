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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Patient::class);
            $table->date('record_date');
            $table->text('chief_complaint');
            $table->text('present_illness');
            $table->text('mental_status_examination');
            $table->string('body_weight', 6, 2);
            $table->string('blood_pressure');
            $table->string('pulse');
            $table->text('impression');
            $table->datetime('appointment_date');
            $table->string('medical_certificate');
            $table->bigInteger('treatment_costs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
