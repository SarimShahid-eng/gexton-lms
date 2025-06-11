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
        Schema::create('student_registers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('father_name');
            $table->string('gender');
            $table->string('cnic_number')->unique();
            $table->string('contact_number');
            $table->string('date_of_birth');
            $table->string('profile_picture')->nullable();
            $table->string(column: 'intermediate_marksheet')->nullable();
            $table->string('domicile_form_c')->nullable();
            $table->string('domicile_district');
            $table->boolean('is_enrolled');
            $table->string('university_name')->nullable();
            $table->string('preferred_study_center');
            $table->string('preferred_time_slot');
            $table->string('course_choice_1');
            $table->string('course_choice_2');
            $table->string('course_choice_3');
            $table->string('course_choice_4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registers');
    }
};
