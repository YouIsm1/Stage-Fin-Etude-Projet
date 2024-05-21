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
        Schema::create('vendeurs', function (Blueprint $table) {
            $table->bigIncrements('id_Vendeur');
            $table->string('nom')->nullable(false);
            $table->string('prenom')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('mot_de_passe')->nullable(false);

            $table->unsignedBigInteger('id_Role')->nullable(false);
            // Assuming 'id' is the primary key of the 'utilisateurs' table
            $table->foreign('id_Role')->references('id_Role')->on('roles')->onDelete('cascade');

            // Ajout de la colonne ID_administrateur
            $table->unsignedBigInteger('ID_administrateur')->nullable(false);
            // Création de la clé étrangère
            $table->foreign('ID_administrateur')
                  ->references('id_administrateur')
                  ->on('administrateurs')
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
        Schema::dropIfExists('vendeurs');
    }
};
