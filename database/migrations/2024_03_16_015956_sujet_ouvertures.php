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
            Schema::create('sujet_ouvertures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sujet_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            $table->foreign('sujet_id')->references('id')->on('sujets')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            // Assurez-vous qu'un étudiant ne peut ouvrir un sujet qu'une seule fois
            $table->unique(['sujet_id', 'student_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('sujet_ouvertures');
    }
};
