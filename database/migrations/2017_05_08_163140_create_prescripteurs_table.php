<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescripteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescripteurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_hopital');
            $table->string('titre', 20);
            $table->string('nom_prescripteur', 200);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->string('telephone', 50);
            $table->string('fax', 50)->nullable();
            $table->string('sexe', 50);
            $table->string('statut', 1)->default('1');
            $table->string('email', 100)->nullable();
            $table->integer('matricule_agent')->nullable();
            $table->integer('diligence')->nullable();
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
        Schema::dropIfExists('prescripteurs');
    }
}
