<?php

use App\Models\Article;
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
    $articles = Article::all();

    return view('articles', [
        'articles' => $articles
    ]);
});

Route::get('articles/{slug}', function ($slug) {
    return view('article', [
        'article' => Article::find($slug)
    ]);
})->where('slug', '[A-z0-9\-]+');
