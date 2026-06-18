<?php

namespace App\Services;

use OpenSearch\Client;
use OpenSearch\ClientBuilder;

class OpenSearchService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts([
                env('OPENSEARCH_HOST')
            ])
            ->build();
    }

    public function client(): Client
    {
        return $this->client;
    }
}