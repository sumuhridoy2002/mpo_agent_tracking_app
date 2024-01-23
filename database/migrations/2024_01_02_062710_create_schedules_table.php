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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamp('uid');
            $table->string('title');
            $table->unsignedBigInteger('target_id');
            $table->foreign('target_id')->references('id')->on('targets')->onDelete('cascade');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('description');
            $table->string('pharmacy_image')->nullable();
            $table->string('image')->nullable();
            $table->string('prescription')->nullable();
            $table->enum('status', ['Complete', 'Incomplete'])->default('Incomplete');
            $table->text('report')->nullable();
            $table->string('meeting_date')->nullable(); // 25-08-2024
            $table->string('meeting_start_time')->nullable(); // 8:40AM
            $table->string('meeting_end_time')->nullable(); // 3:45PM
            $table->string('completion_lat')->nullable();
            $table->string('completion_lang')->nullable();
            $table->string('completion_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
