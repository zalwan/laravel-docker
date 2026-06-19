<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticlePublicController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.articles', compact('articles'));
    }

    public function show(Article $article): View
    {
        abort_unless($article->status === 'published', 404);

        return view('pages.article-detail', compact('article'));
    }
}
