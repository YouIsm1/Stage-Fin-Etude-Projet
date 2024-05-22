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
        Schema::create('reglements', function (Blueprint $table) {
            $table->bigIncrements('id_reglement');
            $table->decimal('montant_de_reglement', 8, 2)->nullable(false);
            $table->date('date_reglement')->nullable(false);


            $table->unsignedBigInteger('Facture_ID')->nullable();
            $table->foreign('Facture_ID')
                  ->references('id_facture')
                  ->on('factures')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('ID_Utilisateur_R_Client')->nullable();
            $table->foreign('ID_Utilisateur_R_Client')
                  ->references('id_Utilisateur')
                  ->on('utilisateurs')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('ID_Utilisateur_R_Vendeur_Admin')->nullable();
            $table->foreign('ID_Utilisateur_R_Vendeur_Admin')
                  ->references('id_Utilisateur')
                  ->on('utilisateurs')
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
        Schema::dropIfExists('reglements');
    }
};
