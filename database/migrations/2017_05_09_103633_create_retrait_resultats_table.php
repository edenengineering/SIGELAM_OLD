<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetraitResultatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retrait_resultats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_retrait');
            $table->integer('id_resultat');
            $table->integer('user_id');
            $table->date('date_retrait');
            $table->string('retrait_par', 200);
            $table->string('cni', 50);
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
        Schema::dropIfExists('retrait_resultats');
    }
}
