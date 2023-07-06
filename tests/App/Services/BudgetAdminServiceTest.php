<?php

namespace Tests\App\Service;

use App\Models\UserProjectBudgetType;
use App\Services\AdminService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


// php artisan test --filter=BudgetAdminServiceTest

class BudgetAdminServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */

   
    public function testGetFilteredBudgetForAdmin()
    {
        $adminService = new AdminService();

        // Simule a chamada ao método getFilteredBudgetForAdmin()
        $filteredBudgets = $adminService->getFilteredBudgetForAdmin();
    
        // Verifique se os orçamentos filtrados são retornados como um array
        $this->assertIsArray($filteredBudgets);
    }

    public function testGetFilteredBudgetForAdminParams()
    {
        $adminService = new AdminService();
        $budgetType = UserProjectBudgetType::factory()->create();
        // Simule a chamada ao método getFilteredBudgetForAdminParams()
        $filteredBudgets = $adminService->getFilteredBudgetForAdminParams($budgetType->id);
    
        // Verifique se os orçamentos filtrados são retornados como um array
        $this->assertIsArray($filteredBudgets);
    }
}
