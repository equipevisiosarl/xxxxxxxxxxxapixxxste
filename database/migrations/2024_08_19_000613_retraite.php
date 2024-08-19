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
        Schema::create('retraites', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('full_name');
            $table->date('date_naissance');
            $table->string('sexe');
            $table->string('matricule_cnps');
            $table->string('pays');
            $table->integer('id_commune');
            $table->string('lieux_residence');
            $table->text('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retraites');
    }
};
