<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ArticleCollection(Article::cursor());
        //ArticleCollection::collection(Article::cursor());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:20', 'unique:articles,title'],
            'body' => ['required', 'min:10']
        ]);
        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'author_id' => Auth::id() ?? 1
        ]);
        return response()->json([
            'message' => 'Article stored successfully!',
            'Article' => new ArticleResource($article)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return (new ArticleResource($article));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => ['sometimes', 'max:20', 'unique:articles,title'],
            'body' => ['sometimes', 'min:10']
        ]);
        $article->update([
            'title' => $request->title ?? $article->title,
            'slug' => Str::slug($request->title ?? $article->title),
            'body' => $request->body ?? $article->body,
        ]);
        return response()->json([
            'message' => 'Article Updated Successfully!',
            'Updated Article' => new ArticleResource($article)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
