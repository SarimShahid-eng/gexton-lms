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
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_title', 50)->nullable();
            $table->text('course_description')->nullable();
            $table->string('Duration', 60)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->time('test_time')->default('00:00:00');
            $table->integer('questions_limit')->default(1);
            $table->timestamps(); // created_at and updated_at (optional, but recommended)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
