<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->date('date')->nullable(); // Make the date column nullable
            $table->text('detail')->nullable(); // Make the detail column nullable
            $table->integer('selled')->default(0);
            $table->integer('quantity');
            $table->string('maker_name'); // Add maker_name column
            $table->unsignedBigInteger('maker_id'); 
          
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}