<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInstrument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruments', function (Blueprint $table)
        {
            $table->id('inst_id');
            $table->string('inst_name');
            $table->string('inst_slug');
            $table->longText('inst_description');
            $table->unsignedBigInteger('id_inst_typ')->nullable();
            $table->unsignedBigInteger('id_mode')->nullable();
            $table->unsignedBigInteger('id_mark')->nullable();
            $table->timestamps();

            $table->foreign('id_inst_typ')
                ->references('inst_typ_id')
                ->on('instrument_types')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_mode')
                ->references('mode_id')
                ->on('models')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_mark')
                ->references('mark_id')
                ->on('marks')
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
        Schema::dropIfExists('instruments');
    }
}
