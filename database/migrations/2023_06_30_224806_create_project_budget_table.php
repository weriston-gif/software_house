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
        Schema::create('user_project_budget', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 100);
            $table->string('telefone', 50)->nullable();
            $table->string('rua', 100);
            $table->string('numero', 50);
            $table->string('bairro', 50);
            $table->string('cep', 20);
            $table->string('complemento', 100)->nullable();
            $table->string('municipio', 100);
            $table->string('uf', 50);
            $table->string('pais', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_budget');
    }
};
