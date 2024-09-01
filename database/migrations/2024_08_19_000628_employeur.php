<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employeurs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('raison_social');
            $table->string('num_registre_commerce');
            $table->string('nom_responsable');
            $table->string('matricule_cnps');
            $table->string('id_domaine_activite');
            $table->string('effectifs');
            $table->string('pays');
            $table->integer('id_commune');
            $table->string('situation_geographique');
            $table->text('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeurs');
    }
};
