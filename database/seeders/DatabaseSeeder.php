<?php
namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory(5)->create()->each(function ($article) {
            Comment::factory(5)->create([
                'article_id' => $article->id,
            ]);
        });
    }
}
