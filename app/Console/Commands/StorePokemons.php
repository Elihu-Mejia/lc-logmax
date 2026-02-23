<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use App\Services\PokeApiService;
use Illuminate\Console\Command;

class StorePokemons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pokemon:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store all pokemons from PokeAPI to the database';

    /**
     * Execute the console command.
     */
    public function handle(PokeApiService $pokeApiService): void
    {
        $this->info('Fetching pokemon list...');

        $pokemons = $pokeApiService->getAll();
        $count = $pokemons->count();

        $this->info("Found {$count} pokemons. Starting import...");

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        foreach ($pokemons as $pokemonData) {
            $details = $pokeApiService->getDetails($pokemonData['name']);

            if ($details) {
                Pokemon::updateOrCreate(
                    ['name' => $details['name']],
                    [
                        'height' => $details['height'],
                        'weight' => $details['weight'],
                        'type' => $details['types'][0]['type']['name'] ?? 'unknown',
                    ]
                );
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('All pokemons stored successfully.');
    }
}