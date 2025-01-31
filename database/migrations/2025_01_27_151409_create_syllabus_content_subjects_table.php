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
        Schema::create('syllabus_content_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('syllabus_content_id');
            $table->foreign('syllabus_content_id')->references('id')->on('syllabus_contents')->onUpdate('cascade');
            $table->string('chapter_name');
            $table->string('chapter_title');
            $table->longText('chapter_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syllabus_content_subjects');
    }
};
