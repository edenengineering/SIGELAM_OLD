<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_patient');
            $table->string('id_agent', 5);
			$table->string('nom_prescripteur');
			$table->string('numero_facture')->nullable();
			$table->integer('id_agent_editeur')->nullable();
            $table->dateTime('date_dossier');
            $table->string('unite')->nullable();
            $table->integer('reduction')->default(0);
            $table->string('statut', 2)->default('1');
			$table->string('enceinte', 1)->default('0');
			$table->string('etat', 2)->default('5');
            $table->integer('renseignement')->nullable();
            $table->string('urgence', 1);
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
        Schema::dropIfExists('dossiers');
    }
}
