<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * List published articles with optional search & category filter
     */
    public function index(Request $request)
    {
        $query = Article::published()
            ->with(['category', 'author'])
            ->orderByDesc('published_at');

        // Search
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($categorySlug = $request->get('kategori')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
        }

        $articles = $query->paginate(12)->withQueryString();

        $categories = ArticleCategory::active()
            ->withCount(['articles' => fn($q) => $q->published()])
            ->orderBy('sort_order')
            ->get();

        $featuredArticle = Article::published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->first();

        return view('pages.articles.index', compact('articles', 'categories', 'featuredArticle', 'search', 'categorySlug'));
    }

    /**
     * Filter articles by category
     */
    public function category(string $slug)
    {
        $category = ArticleCategory::where('slug', $slug)->firstOrFail();

        $articles = Article::published()
            ->where('category_id', $category->id)
            ->with(['category', 'author'])
            ->orderByDesc('published_at')
            ->paginate(12);

        $categories = ArticleCategory::active()
            ->withCount(['articles' => fn($q) => $q->published()])
            ->orderBy('sort_order')
            ->get();

        $categorySlug = $slug;
        $featuredArticle = null;
        $search = null;

        return view('pages.articles.index', compact('articles', 'categories', 'category', 'featuredArticle', 'categorySlug', 'search'));
    }

    /**
     * Show article detail
     */
    public function show(string $slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->with(['category', 'author'])
            ->firstOrFail();

        // Increment views count
        $article->increment('views_count');

        // Related articles (same category, exclude current)
        $relatedArticles = Article::published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.articles.show', compact('article', 'relatedArticles'));
    }
}
