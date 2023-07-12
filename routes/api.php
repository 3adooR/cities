<?php

use App\Http\Controllers\Api\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
    'middleware' => [
        //ApiAuth::class,
    ]
], function () {
    Route::get('/country', [CountryController::class, 'list'])->name('country.list');
    Route::put('/country/add', [CountryController::class, 'store'])->name('country.store');
    Route::delete('/country/{id}/del', [CountryController::class, 'destroy'])->name('country.delete');
    Route::patch('/country/{id}/update', [CountryController::class, 'update'])->name('country.update');
});

