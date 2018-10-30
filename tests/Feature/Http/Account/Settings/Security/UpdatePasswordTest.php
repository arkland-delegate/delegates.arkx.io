<?php

namespace Tests\Feature\Http\Account\Settings\Security;

use Hash;
use Tests\TestCase;

/**
 * @coversNothing
 */
class UpdatePasswordTest extends TestCase
{
    private $path = '/account/settings/security/password';

    /** @test */
    public function password_can_be_updated()
    {
        $this
            ->actingAs($user = $this->createDelegate())
            ->from($this->path)
            ->putJson($this->path, [
                'current_password'      => 'password',
                'password'              => 'new_password',
                'password_confirmation' => 'new_password',
            ])
            ->assertRedirect($this->path);

        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));
    }

    /** @test */
    public function current_password_is_required()
    {
        $this
            ->actingAs($this->createDelegate())
            ->putJson($this->path, [
                'current_password'      => '',
                'password'              => 'new_password',
                'password_confirmation' => 'new_password',
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('current_password');
    }

    /** @test */
    public function new_password_is_required()
    {
        $this
            ->actingAs($this->createDelegate())
            ->putJson($this->path, [
                'current_password'      => 'password',
                'password'              => '',
                'password_confirmation' => 'new_password',
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('password');
    }

    /** @test */
    public function new_password_confirmation_is_required()
    {
        $this
            ->actingAs($this->createDelegate())
            ->putJson($this->path, [
                'current_password'      => 'password',
                'password'              => 'new_password',
                'password_confirmation' => '',
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('password');
    }

    /** @test */
    public function new_password_confirmation_must_match()
    {
        $this
            ->actingAs($this->createDelegate())
            ->putJson($this->path, [
                'current_password'      => 'password',
                'password'              => 'new_password',
                'password_confirmation' => 'new_password_invalid',
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('password');
    }
}
