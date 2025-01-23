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
        Schema::create('degree_batch_semesters', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('degree_id');
            $table->foreign('degree_id')->references('id')->on('degrees')->onUpdate('cascade');

            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches')->onUpdate('cascade');

            $table->unsignedBigInteger('batch_type_id');
            $table->foreign('batch_type_id')->references('id')->on('batch_types')->onUpdate('cascade');

            $table->unsignedBigInteger('year_semester_id');
            $table->foreign('year_semester_id')->references('id')->on('year_semesters')->onUpdate('cascade');

            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_batch_semesters');
    }
};
