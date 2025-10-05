<?php

namespace App\Traits;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use phpDocumentor\Reflection\Types\Boolean;

trait HasAuthor
{
    public function author()
    {
        return $this->authorRelation;
    }
    public function authorRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function isAuthoredBy(User $user): bool
    {
        return $this->author()->matches($user);
    }
    public function authoredBy(User $author)
    {
        return $this->author()->associate($author);
    }
}
