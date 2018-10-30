<?php

namespace Tests\Feature\Http\Auth\TwoFactor;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

/**
 * @coversNothing
 */
class EmergencyLoginTest extends TestCase
{
    /** @test */
    public function it_can_login_with_a_valid_emergency_token()
    {
        // Arrange...
        $user = factory(User::class)->create([]);
        $user->forceFill([
            'uses_two_factor_auth'  => true,
            'two_factor_reset_code' => Hash::make($emergencyToken = Uuid::uuid4()),
        ])->save();

        // Assert...
        $this->withSession(['arkx:auth:id' => 1])
             ->post('/auth/two-factor/emergency', ['token' => (string) $emergencyToken])
             ->assertRedirect('/dashboard');
    }

    /** @test */
    public function it_can_not_login_with_an_invalid_emergency_token()
    {
        // Arrange...
        $user = factory(User::class)->create([]);
        $user->forceFill([
            'uses_two_factor_auth'  => true,
            'two_factor_reset_code' => Hash::make(Uuid::uuid4()),
        ])->save();

        // Assert...
        $this->withSession(['arkx:auth:id' => 1])
             ->post('/auth/two-factor/emergency', ['token' => 'fake-token'])
             ->assertRedirect('/auth/login')
             ->assertSessionHas('alert.message', 'The emergency token was invalid.');
    }
}
