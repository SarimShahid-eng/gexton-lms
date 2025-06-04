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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('session_year_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('task_title')->nullable();
            $table->text('task_description')->nullable();
            $table->string('number_of_days', 20)->nullable();
            $table->integer('total_marks');
            $table->string('attachment_link')->nullable();
            $table->string('group_name', 200)->nullable();
            $table->integer('assigned_task')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
