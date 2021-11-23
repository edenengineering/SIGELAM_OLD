<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConclusionAutomatiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conclusion_automatiques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_examen');
            $table->integer('id_conclusion');
            $table->string('libelle_redu', 255);
            $table->string('valeur', 255);
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
        Schema::dropIfExists('conclusion_automatiques');
    }
}
