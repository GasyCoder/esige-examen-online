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
       Schema::create('sujets', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name');
            $table->tinyInteger('timer');
            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->unsignedBigInteger('type_sujet_id');
            $table->integer('reference');
            $table->boolean('isActive')->default(true);
            $table->timestamps('dateFin');
             $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_sujet_id')->references('id')->on('type_sujets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sujets');
    }
};
