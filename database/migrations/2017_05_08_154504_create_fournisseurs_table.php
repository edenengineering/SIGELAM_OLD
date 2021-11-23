<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('raison_sociale', 50);
            $table->string('commercial', 255)->nullable();
            $table->string('adresse', 50)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('site_web', 50)->nullable();
            $table->string('statut', 2)->default('1');
            $table->string('fax', 50)->nullable();
            $table->string('email', 50)->nullable();
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
        Schema::dropIfExists('fournisseurs');
    }
}
