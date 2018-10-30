<?php

namespace Tests\Feature\Http\Auth\TwoFactor;

use App\Facades\Authy;
use App\Models\User;
use Tests\TestCase;

/**
 * @coversNothing
 */
class LoginTest extends TestCase
{
    /** @test */
    public function it_can_login_with_a_valid_otp()
    {
        // Mock...
        Authy::shouldReceive('verify')
            ->once()
            ->withArgs(['93976168', 123456789])
            ->andReturn(true);

        // Arrange...
        $user = factory(User::class)->create([]);
        $user->forceFill([
            'uses_two_factor_auth' => true,
            'authy_id'             => 93976168,
        ])->save();

        // Assert...
        $this->withSession(['arkx:auth:id' => 1])
             ->post('/auth/two-factor/login', ['token' => 123456789])
             ->assertRedirect('/dashboard');
    }

    /** @test */
    public function it_can_not_login_with_an_invalid_otp()
    {
        // Mock...
        Authy::shouldReceive('verify')
            ->once()
            ->withArgs(['93976168', 123456789])
            ->andReturn(false);

        // Arrange...
        $user = factory(User::class)->create([]);
        $user->forceFill([
            'uses_two_factor_auth' => true,
            'authy_id'             => 93976168,
        ])->save();

        // Assert...
        $this->withSession(['arkx:auth:id' => 1])
             ->post('/auth/two-factor/login', ['token' => 123456789])
             ->assertRedirect('/auth/login')
             ->assertSessionHas('alert.message', 'The provided one-time password was invalid.');
    }
}
