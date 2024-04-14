<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('sujet_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('student_id');
            $table->json('answers')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->text('reponse_textarea')->nullable();
            $table->string('reference')->nullable();
            $table->timestamp('answered_at')->useCurrent();
            $table->boolean('open')->default(false);
            $table->ipAddress('student_ip')->nullable();
            $table->string('student_user_agent')->nullable();
            $table->string('year_university')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sujet_id')->references('id')->on('sujets')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_answers');
    }
};
