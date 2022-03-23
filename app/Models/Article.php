<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Article
{
    static function all()
    {
        $files = File::files(resource_path('views/articles'));

        return array_map(function ($file) {
            return $file->getContents();
        }, $files);
    }

    static function find($slug)
    {
        $path = resource_path() . "/views/articles/{$slug}.html";

        if (!file_exists($path)) {
            throw new ModelNotFoundException("Article [{$slug}] not found.");
        }

        return Cache::remember("post.{$slug}", 60, function () use ($path) {
            return file_get_contents($path);
        });
    }
}
