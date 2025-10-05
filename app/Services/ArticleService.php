<?php

namespace App\Services;

use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleService
{
    public function index()
    {
        return [
            new ArticleCollection(Article::cursor())
        ];
    }

    public function store(array $data)
    {
        $article = Article::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'body' => $data['body'],
            'author_id' => Auth::id() ?? 1
        ]);
        return
            [
                new ArticleResource($article)
            ];
    }

    public function show(Article $article)
    {
        return [
            new ArticleResource($article)
        ];
    }
    public function update(array $data, Article $article)
    {

        $article->update([
            'title' => $data['title'] ?? $article->title,
            'slug' => Str::slug($data['title'] ?? $article->title),
            'body' => $data['body']  ?? $article->body,
        ]);
        return [
            new ArticleResource($article)
        ];
    }
    public function destroy(Article $article)
    {
        $article->delete();
        return[
            'Article deleted successfuly'
        ];
    }
}
