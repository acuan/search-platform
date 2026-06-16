<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Import;
use App\Models\SearchLog;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

            'sourcesCount' => Source::count(),

            'importsCount' => Import::count(),

            'searchesCount' => SearchLog::count(),

            'usersCount' => User::count(),

            'recentSources' => Source::latest()
                ->take(5)
                ->get(),

            'recentImports' => Import::latest()
                ->take(5)
                ->get(),

            'recentSearches' => SearchLog::latest()
                ->take(10)
                ->get(),
        ]);
    }
}