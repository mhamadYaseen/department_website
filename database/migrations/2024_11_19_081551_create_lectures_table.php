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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('title');
            $table->string('file_path')->nullable();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
=======
>>>>>>> 235aa8fc7f3bf4f4d5ca9daf882f7ed524b4b8a1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
