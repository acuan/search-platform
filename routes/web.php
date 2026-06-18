<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SourceConnectionController;
use App\Http\Controllers\SourceFieldMappingController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportBatchController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchLogController;
use App\Http\Controllers\SavedSearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::redirect('/', '/dashboard');

Route::middleware([])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Sources
    |--------------------------------------------------------------------------
    */

    Route::resource('sources', SourceController::class);

    Route::prefix('sources/{source}')
        ->name('sources.')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | Connection
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/connection',
                [SourceConnectionController::class, 'edit']
            )->name('connection.edit');

            Route::post(
                '/connection',
                [SourceConnectionController::class, 'update']
            )->name('connection.update');

            Route::post(
                '/test-connection',
                [SourceConnectionController::class, 'test']
            )->name('test-connection');

            Route::post(
                '/detect-tables',
                [SourceConnectionController::class, 'detectTables']
            )->name('detect-tables');

            Route::post(
                '/detect-fields',
                [SourceConnectionController::class, 'detectFields']
            )->name('detect-fields');

            /*
            |--------------------------------------------------------------------------
            | Field Mapping
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/mappings',
                [SourceFieldMappingController::class, 'index']
            )->name('mappings.index');

            Route::post(
                '/mappings',
                [SourceFieldMappingController::class, 'store']
            )->name('mappings.store');
        });

    /*
    |--------------------------------------------------------------------------
    | Imports
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'imports',
        ImportController::class
    );

    Route::resource(
        'import-batches',
        ImportBatchController::class
    )->only([
        'index',
        'show'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/search',
        [SearchController::class, 'index']
    )->name('search.index');

    Route::post(
        '/search',
        [SearchController::class, 'search']
    )->name('search.execute');

    /*
    |--------------------------------------------------------------------------
    | Search Logs
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'search-logs',
        SearchLogController::class
    )->only([
        'index',
        'show'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Saved Searches
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'saved-searches',
        SavedSearchController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Administration
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'users',
        UserController::class
    );

    Route::resource(
        'roles',
        RoleController::class
    );

    Route::resource(
        'permissions',
        PermissionController::class
    );


});
