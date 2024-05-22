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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id_categorie');
            $table->string('nom')->unique()->nullable(false);
            $table->string('description');

          
            $table->unsignedBigInteger('ID_Utilisateur_R_administrateur')->nullable(false);
            $table->foreign('ID_Utilisateur_R_administrateur')
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
        Schema::dropIfExists('categories');
    }
};
