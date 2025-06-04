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
        Schema::create('test_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('wrong_ans')->nullable();
            $table->integer('correct_ans')->nullable();
            $table->integer('total_questions')->nullable();
            $table->string('percentage', 50)->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_marks');
    }
};
