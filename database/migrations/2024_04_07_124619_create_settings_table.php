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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name_app');
            $table->boolean('is_disabled')->default(true);
            $table->text('message_disabled')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->integer('exam_session')->nullable();
            $table->string('year_period')->nullable();
            $table->text('conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
