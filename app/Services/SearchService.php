<?php

namespace App\Services;

class SearchService
{
    public function __construct(
        protected OpenSearchService $openSearch
    ) {
    }

    public function search(
        string $query,
        int $size = 50
    ): array {

        $result =
            $this->openSearch
                ->client()
                ->search([

                    'index' =>
                        env(
                            'OPENSEARCH_INDEX'
                        ),

                    'body' => [

                        'size' => $size,

                        'query' => [

                            'multi_match' => [

                                'query' => $query,

                                'fields' => [

                                    'full_text'
                                ]
                            ]
                        ]
                    ]
                ]);

        return $result[
            'hits'
        ][
            'hits'
        ] ?? [];
    }
}