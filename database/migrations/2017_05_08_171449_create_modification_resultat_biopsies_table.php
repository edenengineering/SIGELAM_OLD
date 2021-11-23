<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificationResultatBiopsiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modification_resultat_biopsies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_resultat');
            $table->integer('id_intitule_biopsie');
            $table->text('macroscopie');
            $table->text('microscopie');
            $table->text('conclusion');
            $table->date('date_prelevement');
            $table->time('heure_prelevement');
            $table->text('motif');
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
        Schema::dropIfExists('modification_resultat_biopsies');
    }
}
