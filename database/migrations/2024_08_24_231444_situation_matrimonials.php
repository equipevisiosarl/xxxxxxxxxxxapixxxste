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
        Schema::create('situation_matrimonials', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('situation');
            $table->string('lieu_mariage')->nullable();
            $table->date('date_mariage')->nullable();
            $table->integer('nombre_enfant')->nullable();
            $table->string('nom_conjoint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situation_matrimonials');
    }
};
