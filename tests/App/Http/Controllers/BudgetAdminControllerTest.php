<?php

namespace Tests\App\Http\Controllers;

use App\Models\User;
use App\Models\UserProjectBudgetType;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

// php artisan test --filter=BudgetAdminControllerTest

class BudgetAdminControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAdminRoute()
    {
        $user = User::factory()->create(['role_admin' => false]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(302);

        $response->assertRedirect(RouteServiceProvider::HOME);

        $adminUser = User::factory()->create(['role_admin' => true]);

        $response = $this->actingAs($adminUser)->get('/admin');
        $response->assertStatus(200);
    }

    public function testAdminIndex()
    {
        $adminUser = User::factory()->create(['role_admin' => true]);

        $response = $this->actingAs($adminUser)->get('/admin');

        $response->assertStatus(200);

        $response->assertViewIs('admin.index');

        $response->assertViewHas('data_users');
    }

    public function testAdminShow()
    {
        $adminUser = User::factory()->create(['role_admin' => true]);

        $budgetType = UserProjectBudgetType::factory()->create();

        $response = $this->actingAs($adminUser)->get('/admin/'.$budgetType->id);

        $response->assertStatus(200);

        $response->assertViewIs('admin.show');

        $response->assertViewHas('data_user');

    }
}
