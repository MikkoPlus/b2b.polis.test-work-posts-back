<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Article::query()
            ->latest()
            ->limit(20)
            ->get()
            ->makeHidden('updated_at'));
    }

    public function show(int $id): JsonResponse
    {
        $article = Article::findOrFail($id);

        return response()->json([
            'article' => $article->makeHidden(['comments', 'updated_at']),
            'comments' => $article->comments->makeHidden(['updated_at']),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_name' => 'required|string|max:255',
        ]);

        /** @var array<string, mixed> $validated */
        $article = Article::create($validated);

        return response()->json($article, 201);
    }
}
