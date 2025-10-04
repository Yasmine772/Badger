<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticleSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::first();
        Article::factory()->count(10)->create([$user->id]);
        Article::factory()->count(10)->create([
            'author_id' => User::factory()
        ]);
    }
}
