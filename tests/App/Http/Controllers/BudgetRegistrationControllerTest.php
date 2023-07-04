<?php

namespace Tests\App\Http\Controllers;


use Tests\TestCase;

class BudgetRegistrationControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
