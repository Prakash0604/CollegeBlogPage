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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('contact');
            $table->string('dob');
            $table->enum('gender',['male','female','others']);
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('is_registered',['approved','pending'])->default('pending');
            $table->unsignedBigInteger('batch_id')->nullable()->comment('2024,2023,2025');
            $table->foreign('batch_id')->references('id')->on('batches')->onUpdate('cascade');

            $table->unsignedBigInteger('batch_type_id')->nullable()->comment('year,semester');
            $table->foreign('batch_type_id')->references('id')->on('batch_types')->onUpdate('cascade');

            $table->unsignedBigInteger('year_semester_id')->nullable()->comment('first semester,second semester');
            $table->foreign('year_semester_id')->references('id')->on('year_semesters')->onUpdate('cascade');

            $table->enum('status',['active','block'])->default('active');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
