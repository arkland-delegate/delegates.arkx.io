<?php

namespace Tests\Browser\Auth;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\TestCase;

/**
 * @coversNothing
 */
class LoginTest extends TestCase
{
    /** @test */
    public function it_can_link_from_the_home_page_to_the_login_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->assertPathIs('/auth/login');
        });
    }

    /** @test */
    public function it_can_login_with_valid_credentials()
    {
        $user = factory(User::class)->create([]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/auth/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/dashboard');
        });
    }

    /** @test */
    public function it_can_not_login_with_invalid_credentials()
    {
        $this->browse(function ($browser) {
            $browser->visit('/auth/login')
                    ->type('email', 'hello@world.com')
                    ->type('password', 'invalid-secret')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records.');
        });
    }
}
