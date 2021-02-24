<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retours', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('retourStocks_id')->index();
            $table->unsignedBigInteger('produit_id')->index();
            $table->integer('qteStock');
            $table->integer('poids')->nullable();
            $table->dateTime('date');

            $table->foreign('retourStocks_id')->references('id')->on('retour_stocks');
            $table->foreign('produit_id')->references('id')->on('produits');

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
        Schema::dropIfExists('retours');
    }
}
