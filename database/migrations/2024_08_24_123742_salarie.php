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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('full_name');
            $table->date('date_naissance')->nullable();
            $table->string('sexe');
            $table->string('matricule_cnps')->nullable();
            $table->string('employeur')->nullable();
            $table->integer('id_employeur')->nullable();
            $table->date('date_embauche')->nullable();
            $table->date('date_immatriculation')->nullable();
            $table->string('poste')->nullable();
            $table->integer('salaire')->nullable();
            $table->string('pays')->nullable();
            $table->integer('id_commune')->nullable();
            $table->string('lieux_residence')->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
