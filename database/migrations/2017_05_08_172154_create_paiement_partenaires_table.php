<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementPartenairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_partenaires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_facture_partenaire');
            $table->integer('user_id');
            $table->date('date_paiement_partenaire');
            $table->time('heure_paiement_partenaire');
			$table->double('verse');
            $table->double('percu');
			$table->string('dossiers');
            $table->double('rembourse');
			$table->integer('type_paiement');
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
        Schema::dropIfExists('paiement_partenaires');
    }
}
