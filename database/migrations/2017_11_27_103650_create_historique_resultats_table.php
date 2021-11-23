<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriqueResultatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_resultats', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_resultat');
			$table->string('old_valeur');
			$table->string('new_valeur');
			$table->string('old_min');
			$table->string('new_min');
			$table->string('old_max');
			$table->string('new_max');
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
        Schema::dropIfExists('historique_resultats');
    }
}
