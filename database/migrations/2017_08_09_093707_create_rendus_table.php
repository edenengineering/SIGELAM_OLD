<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRendusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_examen');
			$table->string('libelle_rendu');
			$table->string('min')->nullable();
			$table->string('max')->nullable();
			$table->integer('ordre')->nullable();
			$table->string('statut', 255)->default('1');
			$table->string('unite')->nullable();
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
        Schema::dropIfExists('rendus');
    }
}
