<?php

namespace Tests\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


# php artisan test --filter=BudgetRegistrationSimplyTest

class BudgetRegistrationSimplyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function teste_index_mobile(): void
    {
        $response = $this->get('/cadastro-orcamento-mobile');

        $response->assertStatus(200);
    }

    public function teste_index_web(): void
    {
        $response = $this->get('/cadastro-orcamento-web');

        $response->assertStatus(200);
    }
    public function teste_index_desktop(): void
    {
        $response = $this->get('/cadastro-orcamento-desktop');

        $response->assertStatus(200);
    }

}
