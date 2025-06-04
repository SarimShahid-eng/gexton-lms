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
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('group_id')->constrained('batch_groups')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->enum('entry_test', ['0', '1'])->default('0');
            $table->enum('test_started', ['0', '1'])->default('0');
            $table->date('suspend_date')->nullable();
            $table->text('reason_suspend')->nullable();
            $table->enum('timer_started', ['0', '1'])->default('0');
            $table->enum('result', ['In_progress', 'pass', 'fail'])->default('In_progress');
            $table->time('test_countdown')->default('00:00:00');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_details');
    }
};
