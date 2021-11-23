<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email')->nullable();
	    $table->string('statut', 2)->default('1');
            $table->string('pseudo', 255)->unique();
            $table->string('password', 255);
            $table->date('date_naissance')->nullable();
            $table->string('adresse', 255);
            $table->string('telephone', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('cni', 20)->nullable();
	    $table->integer('id_agent');
            $table->string('sexe', 20);
            $table->string('societe', 200)->nullable();
            $table->boolean('logout')->default(false);
            $table->string('lprofile')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
