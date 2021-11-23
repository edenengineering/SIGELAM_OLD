<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricule_agent', 5)->unique();
            $table->integer('code_motif_depart');
            $table->integer('code_fonction');
            $table->string('nom_agent', 200);
            $table->date('date_naissance');
            $table->string('lieu_naissance', 100);
            $table->string('sexe', 10);
            $table->string('telephone', 20);
            $table->string('fax', 20);
            $table->string('mail', 100);
            $table->date('date_embauche');
            $table->date('date_titularisation');
            $table->date('date_depart');
            $table->string('statut', 1);
            $table->string('cnps', 20);
            $table->integer('titularisation');
            $table->string('adresse', 50);

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
        Schema::dropIfExists('agents');
    }
}
