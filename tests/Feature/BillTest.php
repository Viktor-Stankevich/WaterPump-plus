<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BillTest extends TestCase
{
    public function testShowBill()
    {
        $response = $this->post('/api/bill', [
            'month' => '2021-12-01 00:00:00'
        ]);
        $response->assertOk();
    }
}
