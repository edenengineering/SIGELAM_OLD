<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_examen');
            $table->string('libelle_element', 200);
            $table->string('valeur_max', 100);
            $table->string('valeur_min', 100);
            $table->string('titre', 1);
            $table->string('gras', 1);
            $table->string('unite', 15);
            $table->smallInteger('ordre');

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
        Schema::dropIfExists('elements');
    }
}
