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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('department');
            $table->string('contact_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->unique();
            $table->year('year_passed');
            $table->string('current_job')->nullable();
            $table->string('company_name')->nullable();
            $table->string('job_time_duration')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
