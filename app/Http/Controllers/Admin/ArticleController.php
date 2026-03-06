<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * List all articles for admin
     */
    public function index(Request $request)
    {
        $query = Article::with(['category', 'author'])
            ->orderByDesc('created_at');

        // Filter by status
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Filter by category
        if ($categoryId = $request->get('category')) {
            $query->where('category_id', $categoryId);
        }

        // Search
        if ($search = $request->get('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $articles = $query->paginate(15)->withQueryString();
        $categories = ArticleCategory::active()->orderBy('sort_order')->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show create article form
     */
    public function create()
    {
        $categories = ArticleCategory::active()->orderBy('sort_order')->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store new article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:article_categories,id',
            'excerpt' => 'nullable|string|max:300',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle slug
        $validated['slug'] = Str::slug($validated['title']);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('articles', 'public');
        }

        // Handle tags (comma-separated string → JSON array)
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        // Set author and publishing
        $validated['author_id'] = Auth::guard('admin')->id();
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Show edit article form
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = ArticleCategory::active()->orderBy('sort_order')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update existing article
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category_id' => 'required|exists:article_categories,id',
            'excerpt' => 'nullable|string|max:300',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
        ]);

        // Handle slug
        if (!empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        } else {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('articles', 'public');
        } else {
            unset($validated['featured_image']);
        }

        // Handle tags
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        // Set published_at if publishing for the first time
        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Delete article
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Delete featured image
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Toggle article status (draft ↔ published)
     */
    public function toggleStatus($id)
    {
        $article = Article::findOrFail($id);

        if ($article->status === 'draft') {
            $article->update([
                'status' => 'published',
                'published_at' => $article->published_at ?? now(),
            ]);
            $message = 'Artikel berhasil dipublish!';
        } else {
            $article->update(['status' => 'draft']);
            $message = 'Artikel dikembalikan ke draft.';
        }

        return redirect()->route('admin.articles.index')
            ->with('success', $message);
    }

    /**
     * Handle inline image upload from WYSIWYG editor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $path = $request->file('image')->store('articles/content', 'public');

        return response()->json([
            'location' => Storage::url($path),
        ]);
    }
}
