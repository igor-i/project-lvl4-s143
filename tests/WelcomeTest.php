<?php

namespace Tests;

class WelcomeTest extends TestCase
{
    /**
     * A basic response test.
     *
     * @return void
     */
    public function testApplication()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }
}
