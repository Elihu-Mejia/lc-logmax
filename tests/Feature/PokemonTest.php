<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PokemonTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Prevent actual HTTP requests during testing
        Http::preventStrayRequests();
    }

    public function test_it_can_list_pokemon_paginated()
    {
        Http::fake([
            'https://pokeapi.co/api/v2/pokemon*' => Http::response([
                'count' => 100,
                'results' => [
                    ['name' => 'bulbasaur', 'url' => 'https://pokeapi.co/api/v2/pokemon/1/'],
                    ['name' => 'ivysaur', 'url' => 'https://pokeapi.co/api/v2/pokemon/2/'],
                ],
            ], 200),
        ]);

        $response = $this->getJson('/api/pokemon?limit=2');

        $response->assertOk()
            ->assertJsonCount(2, 'results')
            ->assertJsonPath('results.0.name', 'bulbasaur');
    }

    public function test_it_can_filter_by_type_via_path_parameter()
    {
        Http::fake([
            'https://pokeapi.co/api/v2/type/fire' => Http::response([
                'pokemon' => [
                    ['pokemon' => ['name' => 'charmander', 'url' => '...']],
                    ['pokemon' => ['name' => 'charmeleon', 'url' => '...']],
                ],
            ], 200),
        ]);

        $response = $this->getJson('/api/pokemon/fire');

        $response->assertOk()
            ->assertJsonCount(2, 'results')
            ->assertJsonPath('results.0.name', 'charmander');
    }

    public function test_it_treats_path_parameter_as_name_if_type_not_found()
    {
        Http::fake([
            'https://pokeapi.co/api/v2/type/pikachu' => Http::response([], 404),
            'https://pokeapi.co/api/v2/pokemon?limit=10000' => Http::response([
                'results' => [
                    ['name' => 'pikachu', 'url' => '...'],
                    ['name' => 'raichu', 'url' => '...'],
                ],
            ], 200),
        ]);

        $response = $this->getJson('/api/pokemon/pikachu');

        $response->assertOk()
            ->assertJsonCount(1, 'results')
            ->assertJsonPath('results.0.name', 'pikachu');
    }

    public function test_it_can_filter_by_type_via_query_parameter()
    {
        Http::fake([
            'https://pokeapi.co/api/v2/type/water' => Http::response([
                'pokemon' => [
                    ['pokemon' => ['name' => 'squirtle', 'url' => '...']],
                ],
            ], 200),
        ]);

        $response = $this->getJson('/api/pokemon?type=water');

        $response->assertOk()
            ->assertJsonCount(1, 'results')
            ->assertJsonPath('results.0.name', 'squirtle');
    }
}