<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandeMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_materiels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_commande');
            $table->integer('code_materiel');
            $table->double('prix');
            $table->integer('quantite_commande');
            $table->integer('quantite_livre')->nullable();
            $table->double('total');
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
        Schema::dropIfExists('commande_materiels');
    }
}
