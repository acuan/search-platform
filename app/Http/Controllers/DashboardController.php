<?php

namespace App\Http\Controllers;

use App\Models\Import;
use App\Models\SearchLog;
use App\Models\Source;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

            'sourcesCount' => Source::count(),

            'importsCount' => Import::count(),

            'searchesCount' => SearchLog::count(),

            'usersCount' => User::count(),

            'activeSourcesCount' => Source::where(
                'is_active',
                true
            )->count(),

            'completedImportsCount' => Import::where(
                'status',
                'completed'
            )->count(),

            'recentSources' => Source::latest()
                ->take(10)
                ->get(),

            'sourcesByType' => Source::select(
                    'source_type',
                    DB::raw('count(*) as total')
                )
                ->groupBy('source_type')
                ->get(),

            'recentSearches' => SearchLog::latest()
                ->take(10)
                ->get(),
        ]);
    }
}