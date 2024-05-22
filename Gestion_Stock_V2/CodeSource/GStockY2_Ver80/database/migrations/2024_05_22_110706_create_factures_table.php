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
        Schema::create('factures', function (Blueprint $table) {
            $table->bigIncrements('id_facture');
            $table->decimal('montant_totale', 8, 2)->nullable(false);
            $table->enum('StatusReglement', ['En cours', 'Terminée'])->nullable(false);

            // ajouter id du commande comme key étrangère
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
        Schema::dropIfExists('factures');
    }
};
