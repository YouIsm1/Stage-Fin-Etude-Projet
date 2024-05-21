<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit__commandes', function (Blueprint $table) {
            $table->integer('Quantite')->nullable(false);

            // ajouter id du produit comme key etrangere
            $table->bigIncrements('produit_id')->nullable(false);
            $table->foreign('produit_id')->references('id_produit')->on('produits')->onDelete('cascade');

            // ajouter id du commande comme key etrangere
            $table->unsignedBigInteger('commande_id')->nullable(false);
            $table->foreign('commande_id')
                  ->references('id_Commande')
                  ->on('commandes')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('produit__commandes');
    }
};
