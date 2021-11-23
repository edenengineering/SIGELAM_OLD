<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartenairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partenaires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_type_partenaire');
            $table->string('libelle_partenaire',255);
            $table->string('adresse',255)->nullable;
            $table->string('telephone', 255)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('site_web',255)->nullable();
            $table->integer('b_public');
            $table->integer('b_prive')->nullable();
            $table->integer('b_proforma')->nullable();
            $table->integer('reduction');
            $table->string('statut', 2);

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
        Schema::dropIfExists('partenaires');
    }
}
