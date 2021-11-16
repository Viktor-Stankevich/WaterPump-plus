<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResidentTest extends TestCase
{
    public function testShowResidents()
    {
        $response = $this->get('/api/resident');
        $response->assertOk();
    }

    public function testStoreResidents()
    {
        $response = $this->post('/api/resident', [
            'fio' => 'Cole Daugherty',
            'area' => 123.05,
            'start_date' => '2003-03-24'
        ]);
        $response->assertOk();
    }

    public function testUpdateResident()
    {
        $response = $this->put('/api/resident/1', [
            'fio' => 'Update Cole Daugherty',
            'area' => 123.05,
            'start_date' => '2003-03-24'
        ]);
        $response->assertOk();
    }

    // public function testDeleteResident()
    // {
    //     $response = $this->delete('/api/resident/1');
    //     $response->assertOk();
    // }
}
