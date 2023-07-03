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
        //Schema::dropIfExists('user_project_budget_types');
        Schema::create('user_project_budget_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_project_budget_id');
            $table->unsignedBigInteger('type_id');

            $table->bigInteger('browser_support')->nullable();
            $table->bigInteger('platform')->nullable();
            $table->bigInteger('operational_system')->nullable();

            $table->boolean('printer')->default(0);
            $table->boolean('license_access')->default(0);
            $table->boolean('system_pay')->default(0);

            $table->decimal('final_budget_value', 8, 2);
            $table->timestamps();
        
            $table->foreign('user_project_budget_id')->references('id')->on('user_project_budgets')->onDelete('cascade'); // Alterado a referência para "user_project_budget"
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_project_budget_types');
    }
};
