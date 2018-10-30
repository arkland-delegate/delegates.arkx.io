<?php

namespace Tests\Feature\Http\Dashboard\LostAndFound;

use App\Models\Delegate;
use ArkEcosystem\Crypto\Identities\Address;
use ArkEcosystem\Crypto\Identities\PublicKey;
use ArkEcosystem\Crypto\Utils\Message;
use Tests\TestCase;

/**
 * @coversNothing
 */
class VerifyClaimTest extends TestCase
{
    private $invalidMessage = 'The signed message could not be verified! The delegate has been reset.';

    /** @test */
    public function cannot_verify_claim_if_the_message_is_invalid()
    {
        $this->createDelegate();

        $message = Message::sign('Hello World', 'passphrase')->toArray();
        $message['message'] = 'invalid';

        $delegate = factory(Delegate::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($delegate->user)
            ->post("/dashboard/lost-and-found/{$delegate->username}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', $this->invalidMessage);
    }

    /** @test */
    public function cannot_verify_claim_if_the_public_key_does_not_match()
    {
        $this->createDelegate();

        $message = Message::sign('Hello', 'other passphrase')->toArray();

        $delegate = factory(Delegate::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($delegate->user)
            ->post("/dashboard/lost-and-found/{$delegate->username}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', $this->invalidMessage);
    }

    /** @test */
    public function cannot_verify_claim_if_the_message_does_not_match()
    {
        $this->createDelegate();

        $message = Message::sign('Hello', 'passphrase')->toArray();

        $delegate = factory(Delegate::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($delegate->user)
            ->post("/dashboard/lost-and-found/{$delegate->username}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', $this->invalidMessage);
    }

    /** @test */
    public function can_verify_claim_if_the_message_is_valid()
    {
        $this->createDelegate();

        $message = Message::sign('Hello World', 'passphrase')->toArray();

        $delegate = factory(Delegate::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($delegate->user)
            ->post("/dashboard/lost-and-found/{$delegate->username}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', 'The delegate has been verified.');

        $this->assertNull($delegate->fresh()->verification_token);
        $this->assertNotNull($delegate->fresh()->verified_at);
    }
}
