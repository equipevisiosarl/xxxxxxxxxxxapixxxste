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
        Schema::create('documents_demandes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_document_service');
            $table->integer('id_demande');
            $table->text('fichier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_demandes');
    }
};
