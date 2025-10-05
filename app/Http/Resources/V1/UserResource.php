<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->merge(Arr::except(parent::toArray($request), [
                'id',
                'email',
                'email-verified_at',
                'created_at',
                'updated_at',
            ]))
        ];
    }
}
