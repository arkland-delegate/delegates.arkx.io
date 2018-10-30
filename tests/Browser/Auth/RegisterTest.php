<?php

namespace Tests\Browser\Auth;

use Laravel\Dusk\Browser;
use Tests\Browser\TestCase;

/**
 * @coversNothing
 */
class RegisterTest extends TestCase
{
    /** @test */
    public function it_can_link_from_the_home_page_to_the_register_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Register')
                    ->assertPathIs('/auth/register');
        });
    }

    /** @test */
    public function it_can_register_with_valid_credentials()
    {
        $this->browse(function ($browser) {
            $browser->visit('/auth/register')
                    ->type('email', 'hello@world.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('Register')
                    ->assertPathIs('/dashboard');
        });
    }

    // /** @test */
    // public function it_can_not_register_with_invalid_credentials()
    // {
    //     $this->browse(function ($browser) {
    //         $browser->visit('/auth/register')
    //                 ->type('email', 'hello@world.com')
    //                 ->type('password', 'invalid-secret')
    //                 ->press('Register')
    //                 ->assertSee('These credentials do not match our records.');
    //     });
    // }
}
