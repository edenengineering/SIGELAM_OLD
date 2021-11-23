<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_fournisseur');
            $table->string('reference_commande', 20)->nullable();
            $table->dateTime('date_commande');
            $table->double('montant');
			$table->string('etat')->default('1');
            $table->dateTime('date_livraison')->nullable();
            $table->string('statut', 1)->default('1');

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
        Schema::dropIfExists('commandes');
    }
}
