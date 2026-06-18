<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OpenSearchService;

class CreateSearchIndexCommand extends Command
{
    protected $signature = 'search:create-index';

    protected $description = 'Create search index';

    public function handle(
        OpenSearchService $openSearch
    )
    {
        $client = $openSearch->client();

        $index = env(
            'OPENSEARCH_INDEX'
        );

        if (
            $client->indices()
                ->exists([
                    'index' => $index
                ])
        ) {

            $this->info(
                'Index already exists'
            );

            return;
        }

        $client->indices()->create([

            'index' => $index,

            'body' => [

                'settings' => [

                    'number_of_shards' => 1,

                    'number_of_replicas' => 0
                ],

                'mappings' => [

                    'properties' => [

                        'import_id' => [
                            'type' => 'long'
                        ],

                        'source_id' => [
                            'type' => 'long'
                        ],

                        'source_name' => [
                            'type' => 'keyword'
                        ],

                        'indexed_at' => [
                            'type' => 'date'
                        ],

                        'full_text' => [
                            'type' => 'text'
                        ],

                        'normalized_data' => [
                            'type' => 'object',
                            'enabled' => true
                        ],

                        'original_data' => [
                            'type' => 'object',
                            'enabled' => true
                        ]
                    ]
                ]
            ]
        ]);

        $this->info(
            'Index created'
        );
    }
}