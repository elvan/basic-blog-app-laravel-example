<?php

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
    return view('articles');
});

Route::get('article/{slug}', function ($slug) {
    $article = file_get_contents(__DIR__ . "/../resources/views/articles/{$slug}.html");

    return view('article', [
        'article' => $article,
    ]);
})->where('slug', '[A-z0-9\-]+');
