<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //le champ unité fait référence a une liste déroulante avec comme valeur
    //litre
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation')->unique()->nullable();
            $table->string('ref')->unique();
            $table->string('numBonCommande')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('magasin')->nullabe();
            $table->string('etagere')->nullabe();
            $table->string('rangee')->nullable();
            $table->string('unite')->nullable();
            $table->string('priceSeller')->nullable();
            $table->integer('statusTva')->default(0);
            $table->integer('price');
            $table->integer('qteStock');
            $table->integer('qteMin');
            $table->string('poids')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('famille_id')->index();
            $table->unsignedBigInteger('fournisseur_id')->index();
            $table->timestamps();

            $table->foreign('famille_id')->references('id')->on('familles');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
