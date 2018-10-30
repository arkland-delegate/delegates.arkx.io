<?php

namespace Tests\Feature\Http\Auth;

use Tests\TestCase;

/**
 * @coversNothing
 */
class RegisterTest extends TestCase
{
    /** @test */
    public function it_can_register_with_valid_credentials()
    {
        $this->post('/auth/register', [
            'email'                 => 'hello@world.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect('/dashboard');
    }

    /** @test */
    public function it_can_not_register_with_invalid_credentials()
    {
        $this->post('/auth/register', [
            'email'                 => 'hello@world.com',
            'password'              => 'password',
            'password_confirmation' => 'invalid-password',
        ])->assertSessionHasErrors(['password']);
    }
}
