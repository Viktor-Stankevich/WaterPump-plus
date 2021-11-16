<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TariffTest extends TestCase
{
    public function testShowTariff()
    {
        $response = $this->get('/api/tariff');
        $response->assertOk();
    }

    public function testCreateTariff()
    {
        $response = $this->post('/api/tariff', [
            'price' => '2',
            'month' => 11
        ]);
        $response->assertOk();
    }

    public function testUpdateTariff()
    {
        $response = $this->put('/api/tariff/1', [
            'price' => '100',
            'month' => 12
        ]);
        $response->assertOk();
    }

    // public function testDeleteTariff()
    // {
    //     $response = $this->delete('/api/tariff/2');
    //     $response->assertOk();
    // }
}
