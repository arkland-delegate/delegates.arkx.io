<?php

namespace Tests\Browser\Auth\Password;

use App\Models\User;
use Hash;
use Laravel\Dusk\Browser;
use Tests\Browser\TestCase;

/**
 * @coversNothing
 */
class ResetTest extends TestCase
{
    /** @test */
    public function it_can_reset_the_password()
    {
        $newPassword = 'new_password';

        $user = factory(User::class)->create([]);

        $this->browse(function (Browser $browser) use ($user, $newPassword) {
            $browser
                ->visit('/auth/password/reset')
                ->type('email', $user->email)
                ->press('Send Password Reset Link')
                ->clickLink('Preview Sent Email')
                ->assertSee('Reset Password');

            $passwordResetUrl = $browser->attribute('a.button.button-blue', 'href');

            $browser
                ->visit($passwordResetUrl)
                ->assertSee('Reset Password')
                ->type('email', $user->email)
                ->type('password', $newPassword)
                ->type('password_confirmation', $newPassword)
                ->press('Reset Password')
                ->assertPathIs('/dashboard');
        });

        $this->assertTrue(Hash::check($newPassword, $user->fresh()->password));
    }
}
