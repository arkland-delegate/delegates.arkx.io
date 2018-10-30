<?php

namespace App\Services\Security;

use Authy\AuthyApi;

class Authy
{
    /**
     * The Authy API client.
     *
     * @var string
     */
    private $client;

    /**
     * Create a new Authy instance.
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->client = new AuthyApi($key);
    }

    /**
     * Enable two-factor authentication for a given number.
     *
     * @param string $email
     * @param int    $phoneNumber
     * @param int    $countryCode
     *
     * @return string
     */
    public function enable(string $email, int $phoneNumber, int $countryCode): string
    {
        return $this->client
            ->registerUser($email, $phoneNumber, $countryCode)
            ->id();
    }

    /**
     * Disable two-factor authentication for the user.
     *
     * @param string $authyId
     */
    public function disable(string $authyId): void
    {
        $this->client->deleteUser($authyId);
    }

    /**
     * Verify that the given token is valid for the user.
     *
     * @param string $authyId
     * @param int    $token
     *
     * @return bool
     */
    public function verify(string $authyId, int $token): bool
    {
        return $this->client->verifyToken($authyId, $token)->ok();
    }
}
