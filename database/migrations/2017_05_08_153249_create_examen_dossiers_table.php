<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_dossier');
            $table->integer('code_examen');
			$table->integer('quantite');
			$table->integer('prix_unitaire');
			$table->integer('prix_total');
			$table->integer('reduction');
			$table->integer('delai');
			$table->integer('prix_net');
            $table->integer('preleve')->default(0);
			
			
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
        Schema::dropIfExists('examen_dossiers');
    }
}
