<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\V1\ArticleCollection;
use App\Http\Resources\V1\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use App\Traits\apiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;

class ArticleController extends Controller
{
    use apiResponseTrait;
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        try {
            return $this->successResponse($this->articleService->index(), 'Success', 200);
        } catch (Throwable $th) {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
    }


    public function store(CreateArticleRequest $request)
    {
        try {
            $data = $this->articleService->store($request->validated());
            return $this->successResponse($data, 'Article created successfully', 201);
        } catch (Throwable $th) {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
    }


    public function show(Article $article)
    {
        try {
            $data = $this->articleService->show($article);
            return $this->successResponse($data, 'Success', 200);
        } catch (Throwable $th) {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        try {
            $data = $this->articleService->Update($request->validated(), $article);
            return $this->successResponse($data, 'Article updated successfully', 200);
        } catch (Throwable $th) {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            $data = $this->articleService->destroy($article);
            return $this->successResponse($data, 'Success', 200);
        } catch (Throwable $th) {
            return $this->ErrorResponse($th->getMessage(), $th->getCode());
        }
    }
}
