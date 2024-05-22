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
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id_stock');
            $table->unsignedBigInteger('ID_Utilisateur_R_Fournisseur');
            $table->unsignedBigInteger('ID_Produit');
            $table->unsignedBigInteger('ID_Utilisateur_R_administrateur');
            $table->integer('Quantite')->nullable(false);
            $table->string('status')->nullable(false);
            $table->timestamps();

            $table->foreign('ID_Produit')->references('id_produit')->on('produits')->onDelete('cascade');
            // Foreign keys
            $table->foreign('ID_Utilisateur_R_Fournisseur')->references('id_Utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('ID_Utilisateur_R_administrateur')->references('id_Utilisateur')->on('utilisateurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
