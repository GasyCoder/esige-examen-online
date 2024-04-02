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
        Schema::create('sujet_openes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sujet_uuid')->constrained('sujets', 'uuid')->cascadeOnDelete();
            $table->unsignedBigInteger('student_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->ipAddress('student_ip')->nullable();
            $table->text('student_user_agent')->nullable();
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamps();

            // Assurez-vous qu'un étudiant ne peut ouvrir un sujet qu'une seule fois
            $table->unique(['sujet_uuid', 'student_id'], 'unique_sujet_student');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('sujet_openes');
    }
};
