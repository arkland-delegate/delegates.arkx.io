<?php

namespace App\Services\Ark;

use GrahamCampbell\GuzzleFactory\GuzzleFactory;

class Client
{
    private $client;

    public function __construct()
    {
        $this->client = GuzzleFactory::make([
            'base_uri' => config('ark.host'),
        ]);
    }

    public function wallet(string $address): array
    {
        return $this->get('api/accounts', compact('address'))['account'];
    }

    public function voters(string $publicKey): array
    {
        return $this->get('api/delegates/voters', compact('publicKey'))['accounts'];
    }

    public function delegates(int $page = 0, int $perPage = 50): array
    {
        return $this->get('api/delegates', [
            'offset' => $page * $perPage,
            'limit'  => $perPage,
        ])['delegates'];
    }

    public function delegate(): array
    {
        return $this->get('api/delegates/get', [
            'username' => config('delegate.username'),
        ])['delegate'];
    }

    public function lastBlock(string $publicKey): array
    {
        return $this->get('api/blocks', [
            'generatorPublicKey' => $publicKey,
            'limit'              => 1,
            'orderBy'            => 'height:desc',
        ])['blocks'][0];
    }

    public function supply(): int
    {
        return $this->get('api/blocks/getSupply')['supply'];
    }

    public function get(string $path, array $query = []): array
    {
        $response = $this->client->get($path, compact('query'));

        return json_decode($response->getBody(), true);
    }
}
