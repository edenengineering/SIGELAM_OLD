<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_facture');
            $table->date('date_paiement');
            $table->time('heure_paiement');
			$table->integer('id_agent');
            $table->double('verse');
            $table->double('percu');
            $table->double('rembourse');
			$table->integer('type_paiement');
			$table->integer('id_sous_traitant')->nullable();
			$table->string('banque')->nullable();
			$table->string('numero_cheque')->nullable();


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
        Schema::dropIfExists('paiements');
    }
}
