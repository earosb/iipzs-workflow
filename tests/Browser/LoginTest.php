<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('secret'),
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/home');
        });
    }
}
