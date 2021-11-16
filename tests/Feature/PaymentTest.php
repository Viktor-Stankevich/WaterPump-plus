<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{

    public function testPayment()
    {
        $response = $this->post('/api/payment', [
            'amount_volume' => 43
        ]);
        $response->assertOk();
    }

    public function testShowCalculateForm()
    {
        $response = $this->get('/api/showCalculateForm');
        $response->assertOk();
    }

}
