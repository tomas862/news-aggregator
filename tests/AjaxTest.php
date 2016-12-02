<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AjaxTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAjaxFilter()
    {
        $response = $this->call('POST', '/user', ['filters' => null]);
    }
}
