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

        Schema::create('custom_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_year', 40)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->tinyInteger('is_selected')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('custom_sessions');
    }
};
