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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id_clients');
            $table->string('nom')->nullable(false);
            $table->string('prenom')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('mot_de_passe')->nullable(false);

            $table->unsignedBigInteger('id_Role')->nullable(false);
            // Assuming 'id' is the primary key of the 'utilisateurs' table
            $table->foreign('id_Role')->references('id_Role')->on('roles')->onDelete('cascade');

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

            // $table->string('RoleGestionnaire')->nullable(false);

            // $table->unsignedBigInteger('ID_gestionnaire')->nullable(false);
            $table->enum('RoleGestionnaire', ['admin', 'vendeur'])->nullable(false);

            // Clé étrangère sur un des deux types de gestionnaire en fonction du type
            // $table->foreign('ID_gestionnaire')->references('id_administrateur')->on('administrateurs')->onDelete('cascade');
            // $table->foreign('ID_gestionnaire')->references('id_Vendeur')->on('vendeurs')->onDelete('cascade');

            $table->timestamps();
        });

        // // Créer la contrainte de clé étrangère pour les administrateurs
        // Schema::table('clients', function (Blueprint $table) {
        //     $table->foreign('ID_gestionnaire')->references('id_administrateur')->on('administrateurs')
        //           ->where('RoleGestionnaire', 'admin')
        //           ->onDelete('cascade');
        // });

        // // Créer la contrainte de clé étrangère pour les vendeurs
        // Schema::table('clients', function (Blueprint $table) {
        //     $table->foreign('ID_gestionnaire')->references('id_Vendeur')->on('vendeurs')
        //           ->where('RoleGestionnaire', 'vendeur')
        //           ->onDelete('cascade');
        // });

        // // Ajout des contraintes de clé étrangère dans des migrations distinctes
        // Schema::table('clients', function (Blueprint $table) {
        //     $table->foreign('ID_gestionnaire')
        //           ->references('id_administrateur')
        //           ->on('administrateurs')
        //           ->onDelete('cascade');
        // });

        // Schema::table('clients', function (Blueprint $table) {
        //     $table->foreign('ID_gestionnaire')
        //           ->references('id_Vendeur')
        //           ->on('vendeurs')
        //           ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
