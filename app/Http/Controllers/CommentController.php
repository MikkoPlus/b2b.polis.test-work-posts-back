<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, int $articleId): JsonResponse
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $article = Article::findOrFail($articleId);

        /** @var array<string, mixed> $validated */
        $comment = $article->comments()->create($validated);

        return response()->json($comment, 201);
    }
}
