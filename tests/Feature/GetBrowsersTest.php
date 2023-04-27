<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetBrowsersTest extends TestCase
{
    /**
     * test if the api returns the pre stored browsers.
     */
    public function testSuccess(): void
    {
        $response = $this->get('/api/browsers');

        $response->assertStatus(200);

        $response->assertJson([
            ['id' => 1, 'name' => 'Chrome'],
            ['id' => 2, 'name' => 'Edge'],
            ['id' => 3, 'name' => 'Firefox'],
            ['id' => 4, 'name' => 'Safari'],
        ]);
    }
}
