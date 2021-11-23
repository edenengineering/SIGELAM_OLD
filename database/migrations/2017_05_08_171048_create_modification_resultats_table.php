<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificationResultatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modification_resultats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_resultat');
            $table->integer('user_id');
            $table->integer('id_element');
            $table->string('valeur', 50);
            $table->string('valeur_max', 50);
            $table->string('valeur_min', 50);
            $table->text('motif');
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
        Schema::dropIfExists('modification_resultats');
    }
}
