<?php

namespace Tests\Feature\Http\Auth;

use App\Notifications\MagicLink;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

/**
 * @coversNothing
 */
class MagicLoginTest extends TestCase
{
    private $path = '/auth/login/magic';

    /** @test */
    public function guest_can_request_a_magic_link()
    {
        $this->withoutExceptionHandling();

        Notification::fake();

        $user = $this->createUser();

        $this
            ->from($this->path)
            ->post($this->path, $this->validAttributes(['email' => $user->email]))
            ->assertStatus(302)
            ->assertRedirect($this->path);

        Notification::assertSentTo([$user], MagicLink::class);
    }

    /** @test */
    public function can_login_with_a_magic_link()
    {
        $user = $this->createUser();

        $signed = URL::temporarySignedRoute('login.magic', now()->addMinutes(30), ['user' => $user->id]);

        $this
            ->get($signed)
            ->assertStatus(302)
            ->assertRedirect('/dashboard');
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
