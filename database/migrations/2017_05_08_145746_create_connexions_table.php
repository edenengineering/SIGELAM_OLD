<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnexionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connexions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_name', 100);
            $table->integer('num_ordre');
            $table->string('etat_connexion', 1);
            $table->date('date_connexion');
            $table->timestamp('heure_connexion');
            $table->timestamp('heure_deconnexion');
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
        Schema::dropIfExists('connexions');
    }
}
