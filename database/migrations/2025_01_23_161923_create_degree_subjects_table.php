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
        Schema::create('degree_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('degree_batch_semester_id');
            $table->foreign('degree_batch_semester_id')->references('id')->on('degree_batch_semesters')->onUpdate('cascade');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on("subjects")->onUpdate('cascade');
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_subjects');
    }
};
