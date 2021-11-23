<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTubeExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tube_examens', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_tube');
			$table->integer('id_dossier');
			$table->integer('id_groupe_examen');
			$table->integer('preleve')->default(0);
            $table->string('libelle_exam', 20)->nullable();
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
        Schema::dropIfExists('tube_examens');
    }
}
