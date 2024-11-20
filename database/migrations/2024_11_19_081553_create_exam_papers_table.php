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
        Schema::create('exam_papers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('subject_id'); // Foreign key to subjects
            $table->string('file_path'); // Path to the uploaded exam paper file
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_papers');
    }
};
