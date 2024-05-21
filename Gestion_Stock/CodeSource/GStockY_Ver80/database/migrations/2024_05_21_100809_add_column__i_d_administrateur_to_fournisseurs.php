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
        Schema::table('fournisseurs', function (Blueprint $table) {
            // $table->unsignedBigInteger('ID_administrateur')->nullable(false);
            // $table->foreign('ID_administrateur')->references('id_administrateur')->on('administrateurs')->onDelete('cascade');

            // Ajout de la colonne ID_administrateur
            $table->unsignedBigInteger('ID_administrateur')->nullable(false);
            // Création de la clé étrangère
            $table->foreign('ID_administrateur')
                  ->references('id_administrateur')
                  ->on('administrateurs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            // Suppression de la clé étrangère
            $table->dropForeign(['ID_administrateur']);
            // Suppression de la colonne ID_administrateur
            $table->dropColumn('ID_administrateur');
        });
    }
};