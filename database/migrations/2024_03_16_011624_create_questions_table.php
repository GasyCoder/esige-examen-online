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
            $table->string('typeQuestion'); 
            $table->mediumText('generalQuestion')->nullable(); //for only qcm question type
            $table->json('chooseResponse')->nullable(); // reponse de question generale
            $table->json('correctResponse')->nullable(); //check un seul reponse vrai
            $table->json('pointResponse')->nullable(); // qcm point

            $table->text('question_texte')->nullable(); // for only text
            $table->text('image_required')->nullable();

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
