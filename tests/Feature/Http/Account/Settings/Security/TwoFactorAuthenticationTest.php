<?php

namespace Tests\Feature\Http\Account\Settings\Security;

use App\Facades\Authy;
use Tests\TestCase;

/**
 * @coversNothing
 */
class TwoFactorAuthenticationTest extends TestCase
{
    private $path = '/account/settings/security/two-factor-auth';

    /** @test */
    public function authentication_can_be_enabled()
    {
        Authy::shouldReceive('enable')->once()->andReturn(123456789);

        $this
            ->actingAs($user = $this->createDelegate())
            ->from($this->path)
            ->postJson($this->path, $this->validAttributes())
            ->assertRedirect($this->path);

        $this->assertNotNull($user->authy_id);
    }

    /** @test */
    public function country_code_is_required()
    {
        $this
            ->actingAs($this->createDelegate())
            ->postJson($this->path, $this->validAttributes(['country_code' => '']))
            ->assertStatus(422)
            ->assertJsonValidationErrors('country_code');
    }

    /** @test */
    public function phone_is_required()
    {
        $this
            ->actingAs($this->createDelegate())
            ->postJson($this->path, $this->validAttributes(['phone' => '']))
            ->assertStatus(422)
            ->assertJsonValidationErrors('phone');
    }

    /** @test */
    public function authentication_can_be_disabled()
    {
        Authy::shouldReceive('enable')->once()->andReturn(123456789);

        $user = $this->createDelegate();

        $this
            ->actingAs($user)
            ->from($this->path)
            ->postJson($this->path, $this->validAttributes())
            ->assertRedirect($this->path);

        $this->assertNotNull($user->authy_id);

        Authy::shouldReceive('disable')->once();

        $this
            ->actingAs($user)
            ->from($this->path)
            ->delete($this->path)
            ->assertRedirect($this->path);

        $this->assertNull($user->fresh()->authy_id);
    }

    private function validAttributes(array $overrides = []): array
    {
        return $overrides + [
            'country_code' => 1,
            'phone'        => 1111111111,
        ];
    }
}
