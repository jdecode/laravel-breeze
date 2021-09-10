<?php

use App\Jobs\HelloWorld;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/hello-world', function () {
    HelloWorld::dispatch();
    Log::info('Logging from web-route');
    die('This is a Hello World page!');
})->name('hello-world');

Route::get('/sub-of-pub-for-cloud-run-deployment', function () {
    Log::info('Triggered via Pub Sub, when new revision is deployed on cloud run');
    Log::log('debug', 'Debugging by logging');
    die('This is a pub-sub trigger page');
})->name('sub-of-pub-for-cloud-run-deployment');

require __DIR__.'/auth.php';
