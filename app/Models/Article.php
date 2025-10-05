<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasAuthor;
    use ModelHelpers;
    use HasFactory;

    protected $fillable =
    [
        'title',
        'slug',
        'body',
        'author_id'
    ];

    // public function id(): string
    // {
    //     return (string) $this->id;
    // }
    // public function title(): string
    // {
    //     return $this->title;
    // }
    // public function slug(): string
    // {
    //     return $this->slug;
    // }
    // public function body(): string
    // {
    //     return $this->body;
    // }
}
