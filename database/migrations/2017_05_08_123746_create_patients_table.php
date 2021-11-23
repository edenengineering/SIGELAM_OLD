<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule', 15)->nullable();
            $table->string('nom_patient', 255);
            $table->date('date_naissance');
            $table->string('adresse', 255);
            $table->string('telephone', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('cni', 20)->nullable();
			$table->integer('id_agent');
            $table->string('email', 200)->nullable();
            $table->string('sexe', 20);
            $table->string('statut', 2)->default('1');
            $table->string('societe', 200)->nullable();
			$table->integer('montant_avoir')->default(0);

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
        Schema::dropIfExists('patients');
    }
}
