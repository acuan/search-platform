<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view(
            'search.index'
        );
    }

    public function search(
        Request $request,
        SearchService $service
    ) {

        $request->validate([

            'query' => [
                'required'
            ]
        ]);

        $results =
            $service->search(
                $request->query
            );

        return view(
            'search.index',
            [
                'query' => $request->query,
                'results' => $results
            ]
        );
    }
}