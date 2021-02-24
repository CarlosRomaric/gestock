<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('bon_sorties_id')->index();
            $table->unsignedBigInteger('produit_id')->index();
            $table->dateTime('date');
            $table->integer('qteStock');
            $table->timestamps();

            $table->foreign('bon_sorties_id')->references('id')->on('bon_sorties');
            $table->foreign('produit_id')->references('id')->on('produits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sorties');
    }
}
