<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriqueRedevancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('historique_redevances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_prescripteur');
            $table->integer('diligence');
            $table->integer('code_dossier');
            $table->integer('pourcentage');
            $table->integer('code_examen');
            $table->integer('prix_examen');
            $table->dateTime('date_dossier');


            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historique_redevances');
    }
}
