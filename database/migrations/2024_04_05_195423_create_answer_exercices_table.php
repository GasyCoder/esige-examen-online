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
        Schema::create('answer_exercices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('exercice_id');
            $table->unsignedBigInteger('student_id');
            $table->ipAddress('student_ip')->nullable();
            $table->text('student_user_agent')->nullable();
            $table->timestamp('answered_at')->useCurrent();
            $table->integer('reference');
            $table->string('year_university')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('exercice_id')->references('id')->on('exercices')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_exercices');
    }
};
