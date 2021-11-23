<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedevanceAssurePrescripteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redevance_assure_prescripteurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_redevance_assure');
            $table->integer('id_prescripteur');
            $table->string('nom_patient', 200);
            $table->integer('id_dossier');
            $table->date('date_dossier');
            $table->double('montant');
            $table->integer('taux_redevance');
            $table->integer('redevance');
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
        Schema::dropIfExists('redevance_assure_prescripteurs');
    }
}
