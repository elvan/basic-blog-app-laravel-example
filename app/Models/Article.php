<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Article
{
    public function __construct(
        public $title,
        public $excerpt,
        public $date,
        public $body,
        public $slug
    ) {
    }

    static function all()
    {
        return Cache::remember('articles.all', now()->addSeconds(5), function () {
            $files = File::files(resource_path('articles'));

            return collect($files)->map(function ($file) {
                $document = YamlFrontMatter::parseFile($file);

                return new Article(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            })->sortByDesc('date');
        });
    }

    static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }
}
