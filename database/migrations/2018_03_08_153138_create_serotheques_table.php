<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerothequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serotheques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_nature');
            $table->integer('id_pathologie')->nullable();
            $table->string('genre');
            $table->integer('id_quartier');
            $table->string('caractere_id');
            $table->date('preleve_le');
            $table->date('date_naissance');
            $table->string('statut', '1')->default('1');
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
        Schema::dropIfExists('serotheques');
    }
}
