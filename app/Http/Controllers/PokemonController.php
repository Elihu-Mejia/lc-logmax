<?php

namespace App\Http\Controllers;

use App\Services\PokeApiService;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function __construct(protected PokeApiService $pokeApiService) {}

    public function index(Request $request, $key = null)
    {
        $limit = $request->input('limit', 20);
        $offset = $request->input('offset', 0);
        $name = $request->input('name');
        $type = $request->input('type');

        if ($key) {
            $results = $this->pokeApiService->getByType($key);

            if (! $results) {
                $name = $key;
            }
        }

        if (! isset($results) && $type) {
            $results = $this->pokeApiService->getByType($type);

            if (! $results) {
                return ['count' => 0, 'results' => []];
            }
        } elseif (! isset($results) && $name) {
            $results = $this->pokeApiService->getAll();
        } elseif (! isset($results)) {
            return $this->pokeApiService->getPaginated($limit, $offset);
        }

        if ($name) {
            $results = $results->filter(fn ($pokemon) => str_contains($pokemon['name'], strtolower($name)));
        }

        return [
            'count' => $results->count(),
            'results' => $results->slice($offset, $limit)->values(),
        ];
    }
}