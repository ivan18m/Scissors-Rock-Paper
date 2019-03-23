<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementStrengthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_strength', function (Blueprint $table) {
            $table->bigInteger('element_id')->unsigned();
            $table->foreign('element_id')
                ->references('id')->on('element')
                ->onDelete('cascade');
            $table->bigInteger('strength_id')->unsigned();
            $table->foreign('strength_id')
                ->references('id')->on('element')
                ->onDelete('cascade');
            $table->primary(['element_id', 'strength_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('element_strength');
    }
}
