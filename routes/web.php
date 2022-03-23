<?php

use Illuminate\Support\Facades\Cache;
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
    $path = __DIR__ . "/../resources/views/articles/{$slug}.html";

    if (!file_exists($path)) {
        abort(404);
    }


    $article = Cache::remember("post.{$slug}", 3600, function () use ($path) {
        return file_get_contents($path);
    });

    return view('article', [
        'article' => $article,
    ]);
})->where('slug', '[A-z0-9\-]+');
