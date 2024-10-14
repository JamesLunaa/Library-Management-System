<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowedbooks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('libraryId');
            $table->string('title');
            $table->string('date');
            $table->string('accNo');
            $table->string('status');
            $table->date('borrowedDate');
            $table->integer('duration');
            $table->integer('delay');
            $table->string('form');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('borrowedbooks');
    }
};