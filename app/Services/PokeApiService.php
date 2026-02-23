<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PokeApiService
{
    protected string $baseUrl = 'https://pokeapi.co/api/v2';

    public function getByType(string $type): ?Collection
    {
        $response = Http::get("{$this->baseUrl}/type/{$type}");

        if ($response->successful()) {
            return collect($response->json()['pokemon'])->pluck('pokemon');
        }

        return null;
    }

    public function getAll(): Collection
    {
        $response = Http::get("{$this->baseUrl}/pokemon?limit=10000");

        return collect($response->json()['results']);
    }

    public function getPaginated(int $limit = 20, int $offset = 0): array
    {
        return Http::get("{$this->baseUrl}/pokemon", [
            'limit' => $limit,
            'offset' => $offset,
        ])->json();
    }
}