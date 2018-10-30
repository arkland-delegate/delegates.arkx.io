<?php

namespace Tests\Browser\Auth\Password;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\TestCase;

/**
 * @coversNothing
 */
class ForgotTest extends TestCase
{
    /** @test */
    public function it_can_link_from_the_login_form_to_the_password_reset_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth/login')
                    ->waitForText('Login')
                    ->clickLink('Forgot Your Password?')
                    ->assertPathIs('/auth/password/reset');
        });
    }

    /** @test */
    public function it_can_request_the_password_reset_email()
    {
        $user = factory(User::class)->create([]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->visit('/auth/password/reset')
                ->type('email', $user->email)
                ->press('Send Password Reset Link')
                ->assertSee(__('passwords.sent'))
                ->assertSee('Preview Sent Email');
        });
    }
}
