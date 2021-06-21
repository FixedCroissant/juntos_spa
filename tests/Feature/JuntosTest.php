<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JuntosTest extends TestCase
{

    /**
     * @test
     */
    public function test_only_logged_in_users_can_access_page(){
        $response = $this->get('/')->assertRedirect('/login');
    }
}
