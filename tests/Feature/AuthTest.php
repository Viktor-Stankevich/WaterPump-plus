<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Testing user registration functionality
     */
    public function testRegistration()
    {
        $response = $this->post('/api/registration', [
            'name' => 'Test User',
            'password' => 123456
        ]);
        $response->assertOk();
    }

    /**
     * Testing user authorization functionality
     */
    public function testLogin()
    {
        $response = $this->post('/api/login', [
            'name' => 'Test User',
            'password' => 123456
        ]);
        $response->assertOk();
    }

    /**
     * Testing the user logout functionality
     */
    public function testLogout()
    {
        $response = $this->post('/api/logout');
        $response->assertOk();
    }

}
