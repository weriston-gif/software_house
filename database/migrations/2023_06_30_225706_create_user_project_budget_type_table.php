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
        Schema::create('user_project_budget_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_project_budget_id'); // Alterado o nome da coluna para "user_project_budget_id"
            $table->unsignedBigInteger('type_id');
            $table->decimal('final_budget_value', 8, 2);
            $table->timestamps();
        
            $table->foreign('user_project_budget_id')->references('id')->on('user_project_budget')->onDelete('cascade'); // Alterado a referência para "user_project_budget"
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_project_budget_type');
    }
};
