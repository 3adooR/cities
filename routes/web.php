<?php

use App\Http\Middleware\RedirectIfAnotherCountry;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware([
    'auth',
    'verified',
    RedirectIfAnotherCountry::class,
])->name('dashboard');

Route::get('/forbidden-country', function () {
    return 'This service is not for your country. Sorry :(';
});

require __DIR__.'/auth.php';
