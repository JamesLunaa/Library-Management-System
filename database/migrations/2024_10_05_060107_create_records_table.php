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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('libraryId')->nullable();
            $table->string('title')->nullable();
            $table->string('accNo');
            $table->string('date');
            $table->string('borrowedDate');
            $table->timestamp('return_date')->useCurrent();
            $table->string('remarks')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('records');
    }
};