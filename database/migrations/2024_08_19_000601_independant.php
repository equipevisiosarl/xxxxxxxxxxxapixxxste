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
        Schema::create('independants', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('full_name');
            $table->date('date_naissance')->default(null);
            $table->string('sexe');
            $table->string('matricule_cnps')->default(null);
            $table->string('activite')->default(null);
            $table->integer('id_categorie')->default(null);
            $table->integer('revenue_soumis')->default('000');
            $table->string('pays')->default(null);
            $table->integer('id_commune')->default(null);
            $table->string('lieux_activite')->default(null);
            $table->string('lieux_residence')->default(null);
            $table->text('photo')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('independants');
    }
};
