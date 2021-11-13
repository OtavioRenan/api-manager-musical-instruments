<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('models');
        Schema::create('models', function (Blueprint $table)
        {
            $table->id('mode_id');
            $table->string('mode_name');
            $table->string('mode_slug');
            $table->unsignedBigInteger('id_mode_yea')->nullable();
            $table->timestamps();

            $table->foreign('id_mode_yea')
                ->references('mode_yea_id')
                ->on('model_years')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
}
