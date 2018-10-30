<?php

namespace Tests\Feature\Http\Auth;

use App\Models\User;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ResetPasswordTest extends TestCase
{
    private $path = '/auth/password/reset';

    /** @test */
    public function user_can_set_a_new_password()
    {
        $this->withoutExceptionHandling();

        $token = $this->createResetToken($user = $this->createDelegate());

        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes([
                'email' => $user->email,
                'token' => $token,
            ]))
            ->assertStatus(302)
            ->assertRedirect('dashboard');
    }

    /** @test */
    public function user_cannot_use_an_invalid_reset_token()
    {
        $token = 'invalid-token';

        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes())
            ->assertStatus(302)
            ->assertRedirect($this->path);
    }

    /** @test */
    public function password_is_required()
    {
        $token = $this->createResetToken($this->createDelegate());

        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes(['password' => '']))
            ->assertStatus(302)
            ->assertRedirect($this->path)
            ->assertSessionHasErrors();
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $token = $this->createResetToken($this->createDelegate());

        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes(['password_confirmation' => '']))
            ->assertStatus(302)
            ->assertRedirect($this->path)
            ->assertSessionHasErrors();
    }

    private function validAttributes(array $overrides = []): array
    {
        return $overrides + [
            'password'              => 'password',
            'password_confirmation' => 'password',
        ];
    }

    private function createResetToken(User $user): string
    {
        return app('auth.password.broker')->createToken($user);
    }
}
