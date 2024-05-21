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

            $table->enum('RoleGestionnaire', ['admin', 'vendeur'])->nullable(false);

            // Ajout de la colonne ID_administrateur
            $table->unsignedBigInteger('ID_administrateur')->nullable();
            // Création de la clé étrangère
            $table->foreign('ID_administrateur')
                  ->references('id_administrateur')
                  ->on('administrateurs')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('ID_Vendeur')->nullable();
            // Création de la clé étrangère
            $table->foreign('ID_Vendeur')
                  ->references('id_Vendeur')
                  ->on('vendeurs')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('ID_Client')->nullable();
            // Création de la clé étrangère
            $table->foreign('ID_Client')
                  ->references('id_clients')
                  ->on('clients')
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
