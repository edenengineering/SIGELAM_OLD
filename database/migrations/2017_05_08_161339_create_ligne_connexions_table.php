<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneConnexionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_connexions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_name', 10);
            $table->integer('num_ordre');
            $table->string('topic', 200);
            $table->dateTime('heure_ouverture');
            $table->string('etat_topic', 1);
            $table->dateTime('heure_fermeture');

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
        Schema::dropIfExists('ligne_connexions');
    }
}
