<?php

namespace Tests\Feature\Http\Account\Settings\Profile;

use Tests\TestCase;

/**
 * @coversNothing
 */
class UpdateContactInformationTest extends TestCase
{
    private $path = '/account/settings/profile';

    /** @test */
    public function contact_information_can_be_updated()
    {
        $this
            ->actingAs($this->createDelegate())
            ->from($this->path)
            ->put($this->path, $this->validAttributes([
                'email' => 'hello+updated@app.dev',
            ]))
            ->assertRedirect($this->path);

        $this->assertDatabaseHas('users', [
            'email' => 'hello+updated@app.dev',
        ]);
    }

    /** @test */
    public function email_is_required()
    {
        $this
            ->actingAs($this->createDelegate())
            ->putJson($this->path, $this->validAttributes(['email' => '']))
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');
    }

    private function validAttributes(array $overrides = []): array
    {
        return $overrides + [
            'name'  => 'John Doe',
            'email' => 'hello@app.dev',
        ];
    }
}
