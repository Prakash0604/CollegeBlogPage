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
        Schema::create('year_semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch_type_id');
            $table->foreign('batch_type_id')->references('id')->on('batch_types')->onUpdate('cascade');
            $table->string('title');
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('year_semesters');
    }
};
