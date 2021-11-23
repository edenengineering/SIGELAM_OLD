<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedevanceAssuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redevance_assures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_resultat');
            $table->integer('id_dossier_examen');
            $table->integer('id_element');
            $table->integer('user_id');
            $table->string('valeur', 200);
            $table->string('valeur_max', 200);
            $table->string('valeur_min', 200);
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
        Schema::dropIfExists('redevance_assures');
    }
}
