<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Article;

class ArticleResource extends JsonResource
{
    public static $wrap = 'articles';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'articles',
            'id'   => $this->id,
            'attribute' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'body' => $this->body ,
                'created_at' => $this->created_at,
            ],
            'relationships' =>
            [
                'author' => AuthorResource::make($this->author())
            ],
            'links' => [
                'self' => route('articles.show', ['article'=>$this->id]),
                'related' => route('articles.show',['article'=> $this->slug])
            ]
        ];
    }
    public function with($request)
    {
        return [
            'Status' => 'Success',
        ];
    }
    public function withResponse($request, $response)
    {
        return $response->header('accept', 'application/json');
    }
}
