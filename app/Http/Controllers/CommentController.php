<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'content'     => 'required|string',
        ]);
        $article = Article::findOrFail($articleId);

        $comment = $article->comments()->create($request->only('author_name', 'content'));
        return response()->json($comment, 201);
    }
}
