<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/dashboard');

/*
|--------------------------------------------------------------------------
| Auth Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware([''])->group(function () {

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

    /*
    |--------------------------------------------------------------------------
    | Source Connections
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'source-connections',
        SourceConnectionController::class
    );

    Route::post(
        'source-connections/{sourceConnection}/test',
        [SourceConnectionController::class, 'test']
    )->name('source-connections.test');

    /*
    |--------------------------------------------------------------------------
    | Source Field Mappings
    |--------------------------------------------------------------------------
    */

    Route::get(
        'sources/{source}/mappings',
        [SourceFieldMappingController::class, 'index']
    )->name('sources.mappings.index');

    Route::post(
        'sources/{source}/mappings',
        [SourceFieldMappingController::class, 'store']
    )->name('sources.mappings.store');

    /*
    |--------------------------------------------------------------------------
    | Importaciones
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
    | Buscador
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
    | Historial
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
    | Administración
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

