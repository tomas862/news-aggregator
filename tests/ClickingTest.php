<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class ClickingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginLink()
    {
        $this->visit('/')
            ->click('Login')
            ->seePageIs('/login');
    }

    public function testChangePasswordLink()
    {
        $user = User::find(1);
        $this->actingAs($user)
            ->visit('/')
            ->click('Change password')
            ->seePageIs('/change-password');
    }

    public function testMyCategoriesLink()
    {
        $user = User::find(1);
        $this->actingAs($user)
            ->visit('/')
            ->click('My Categories')
            ->seePageIs('/categories');
    }

    public function testMyFeedsLink()
    {
        $user = User::find(1);
        $this->actingAs($user)
            ->visit('/')
            ->click('My feeds')
            ->seePageIs('/feeds');
    }
}
