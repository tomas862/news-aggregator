<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class FormsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testChangePassword()
    {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/change-password')
            ->type('Taylor', 'username')
            ->type('email@mail.lt', 'email')
            ->type('12345', 'old_password')
            ->type('123456', 'new_password')
            ->type('123456', 'repeat_password')
            ->press('submit_password_change')
            ->seePageIs('/feeds');
    }
}
