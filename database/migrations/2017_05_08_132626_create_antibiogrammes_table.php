<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntibiogrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antibiogrammes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_examen_dossier');
			$table->integer('id_dossier');
			$table->integer('id_examen');
            $table->integer('id_antibiotique');
            $table->string('etat', 20);
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
        Schema::dropIfExists('antibiogrammes');
    }
}
