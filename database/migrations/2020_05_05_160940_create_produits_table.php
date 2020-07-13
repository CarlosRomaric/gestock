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
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation')->unique();
            $table->string('ref')->unique();
            $table->string('subtitle');
            $table->text('description');
            $table->integer('price');
            $table->integer('qteStock');
            $table->integer('qteMin');
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
