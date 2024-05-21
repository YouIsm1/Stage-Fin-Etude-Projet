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
        Schema::create('photos_des__produits', function (Blueprint $table) {
            $table->bigIncrements('id_photo');
            $table->unsignedBigInteger('produit_id'); // clé étrangère pour la relation avec Produit
            $table->string('nom')->nullable(false); // Nom de la photo
            $table->string('path')->nullable(false); // Chemin de la photo
            $table->timestamps();

            // Définir la clé étrangère
            $table->foreign('produit_id')->references('id_produit')->on('produits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos_des__produits');
    }
};
