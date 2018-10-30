<?php

namespace Tests\Feature\Http\Auth;

use App\Models\User;
use Tests\TestCase;

/**
 * @coversNothing
 */
class LoginTest extends TestCase
{
    /** @test */
    public function it_can_login_with_valid_credentials()
    {
        $user = factory(User::class)->create([]);

        $this->post('/auth/login', [
            'email'    => $user->email,
            'password' => 'password',
        ])->assertRedirect('/dashboard');
    }

    /** @test */
    public function it_can_not_login_with_invalid_credentials()
    {
        $user = factory(User::class)->create([]);

        $this->post('/auth/login', [
            'email'    => 'hello@world.com',
            'password' => 'invalid-secret',
        ])->assertRedirect('/')->assertSessionHasErrors(['email']);
    }
}
