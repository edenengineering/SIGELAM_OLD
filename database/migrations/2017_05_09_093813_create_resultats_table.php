<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_dossier_examen');
			$table->integer('id_dossier');
			$table->integer('id_examen');
            $table->integer('id_element');
            $table->integer('user_id');
            $table->string('valeur', 200)->nullable();
            $table->string('max', 200)->nullable();
            $table->string('min', 200)->nullable();
			$table->string('unite', 200)->nullable();
			$table->string('libelle_rendu', 200)->nullable();
			$table->integer('valide')->default(0);
            $table->integer('imprime')->default(0);
            $table->integer('archive')->default(0);

			$table->string('historique', 200)->nullable();
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
        Schema::dropIfExists('resultats');
    }
}
