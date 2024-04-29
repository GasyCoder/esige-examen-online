<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcolagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecolages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('motif');
            $table->string('mode');
            $table->integer('reference')->unique();
            $table->date('datePay');
            $table->integer('nbreMois')->default(10);
            $table->integer('tranche');
            $table->string('year_university')->nullable();
            $table->enum('status', ['pending', 'paye', 'refuse']);
            $table->string('file_joint')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecolages');
    }
}
