<?php

namespace Tests\Feature\Http\Auth;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ForgotPasswordTest extends TestCase
{
    private $path = '/auth/password/email';

    /** @test */
    public function user_can_successfully_request_a_password_reset_link()
    {
        Notification::fake();

        $user = $this->createDelegate();

        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes(['email' => $user->email]))
            ->assertStatus(302)
            ->assertRedirect($this->path);

        Notification::assertSentTo([$user], ResetPassword::class);
    }

    /** @test */
    public function guest_cannnot_successfully_request_a_password_reset_link()
    {
        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes(['email' => 'guest@app.dev']))
            ->assertStatus(302)
            ->assertRedirect($this->path);
    }

    /** @test */
    public function email_is_required()
    {
        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes(['email' => '']))
            ->assertStatus(302)
            ->assertRedirect($this->path)
            ->assertSessionHasErrors();
    }

    /** @test */
    public function email_must_be_valid()
    {
        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes(['email' => 'invalid-email']))
            ->assertStatus(302)
            ->assertRedirect($this->path)
            ->assertSessionHasErrors();
    }

    private function validAttributes(array $overrides = []): array
    {
        return $overrides + ['email' => 'voter@app.dev'];
    }
}
