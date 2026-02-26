<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function show($id)
    {
        return Article::with('comments')->find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'author'  => 'required|string|max:255',
            'preview' => 'required|string',
        ]);
        $article = Article::create($request->only('title', 'content', 'author', 'preview'));
        return response()->json($article, 201);
    }
}
