<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturePartenairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_partenaires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partenaire');
            $table->integer('user_id');
            $table->string('ref_facture');
            $table->date('date_debut');
            $table->date('date_fin');
			$table->integer('total');
			$table->integer('reste_a_payer')->default(0);
			$table->integer('percu')->default(0);
			$table->integer('statut')->default(0);
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
        Schema::dropIfExists('facture_partenaires');
    }
}
