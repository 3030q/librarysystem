<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOhShitItsBrokeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oh_shit_its_broke_models', function (Blueprint $table) {
            $table->id();
            $table->string('book');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dateOfTake');
            $table->date('returned_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oh_shit_its_broke_models');
    }
}
