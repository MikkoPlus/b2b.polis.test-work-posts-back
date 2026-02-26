<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all()->makeHidden('updated_at');
    }

    public function show($id)
    {
        $article = Article::with('comments')->findOrFail($id);

        return response()->json([
            'article'  => $article->makeHidden(['comments', 'updated_at']),
            'comments' => $article->comments->makeHidden(['updated_at']),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'author_name' => 'required|string|max:255',
        ]);
        $article = Article::create($request->only('title', 'content', 'author_name'));
        return response()->json($article, 201);
    }
}
