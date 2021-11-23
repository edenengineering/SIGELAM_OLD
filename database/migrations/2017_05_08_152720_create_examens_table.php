<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_groupe_examen');
            $table->string('statut', 1)->default('1');
            $table->string('libelle_examen', 100);
            $table->integer('delai')->default(7);
			$table->integer('prix');
            $table->string('abreviation', 20)->nullable();
            $table->integer('code_tube')->default(1);
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
        Schema::dropIfExists('examens');
    }
}
