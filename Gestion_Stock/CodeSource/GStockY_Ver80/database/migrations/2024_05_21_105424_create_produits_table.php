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
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id_produit');
            $table->string('nom')->unique()->nullable(false);
            $table->integer('quantite')->nullable(false);
            $table->string('description');
            $table->decimal('prix', 8, 2)->nullable(false);

            // Ajout de la colonne ID_administrateur
            $table->unsignedBigInteger('ID_administrateur')->nullable(false);
            // Création de la clé étrangère
            $table->foreign('ID_administrateur')
                  ->references('id_administrateur')
                  ->on('administrateurs')
                  ->onDelete('cascade');
            
            $table->unsignedBigInteger('id_categorie')->nullable(false);
            // Création de la clé étrangère
            $table->foreign('id_categorie')
                  ->references('id_categorie')
                  ->on('categories')
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
        Schema::dropIfExists('produits');
    }
};
