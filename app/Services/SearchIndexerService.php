<?php

namespace App\Services;

class SearchIndexerService
{
    public function __construct(
        protected OpenSearchService $openSearch
    ) {
    }

    public function bulkIndex(
        array $documents
    ): void {

        if (empty($documents)) {
            return;
        }

        $params = [
            'body' => []
        ];

        foreach ($documents as $document) {

            $params['body'][] = [

                'index' => [

                    '_index' => env(
                        'OPENSEARCH_INDEX'
                    )
                ]
            ];

            $params['body'][] =
                $document;
        }

        $this->openSearch
            ->client()
            ->bulk($params);
    }
}