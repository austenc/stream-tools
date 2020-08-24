<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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
    $fonts = Http::get('https://www.googleapis.com/webfonts/v1/webfonts?key='.Config::get('services.google.key'));

    return view('countdown.setup')->with([
        'fonts' => collect($fonts->json()['items'])->transform(function ($font) {
            return $font['family'];
        }),
    ]);
});

Route::get('/timer', function () {
    return view('countdown.show');
})->name('countdown.show');

Route::view('/commands', 'commands');
