<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedevanceCentreCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redevance_centre_centres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_centre_prescripteur');
            $table->integer('id_redevance_centre');
            $table->string('nom_patient');
            $table->integer('id_dossier');
            $table->date('date_dossier');
            $table->integer('taux_redevance');
            $table->double('montant');
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
        Schema::dropIfExists('redevance_centre_centres');
    }
}
