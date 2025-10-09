<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            $this->collection->toArray();
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
