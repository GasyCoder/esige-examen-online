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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sujet_id');
            $table->enum('type', ['radio', 'checkbox', 'textarea', 'file']); // Utilisez enum pour le type
            $table->string('label');
            $table->json('options')->nullable();
            $table->text('question')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('is_active')->default(false);
            $table->integer('time_limit')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sujet_id')->references('id')->on('sujets')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
