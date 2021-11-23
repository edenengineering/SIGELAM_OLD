<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_dossier');
            $table->dateTime('date_dossier');
            $table->string('examen', 100);
            $table->integer('quantite');
            $table->float('prix');
            $table->string('patient', 100);
            $table->float('indice');
            $table->integer('delai');
            $table->string('assureur', 100);
            $table->integer('reduction');
            $table->string('matricule');
            $table->string('societe', 50);
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
        Schema::dropIfExists('impots');
    }
}
