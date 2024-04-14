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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->text('title_cour');
            $table->text('sub_title');
            $table->timestamps('dateFin');
            $table->text('body')->nullable();
            $table->longText('video_path')->nullable();
            $table->boolean('is_publish')->default(true);
            $table->string('year_university')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
