<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedevanceCentrePrescripteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redevance_centre_prescripteurs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('statut', 200);
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
        Schema::dropIfExists('redevance_centre_prescripteurs');
    }
}
