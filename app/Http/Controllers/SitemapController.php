<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Article;
use App\Models\ArticleCategory;

class SitemapController extends Controller
{
    public function index()
    {
        // 1. Static Pages
        $staticPages = [
            '/' => 'daily',
            '/tentang' => 'weekly',
            '/jadwal' => 'daily',
            '/galeri' => 'weekly',
            '/testimoni' => 'weekly',
            '/kontak' => 'monthly',
            '/register' => 'monthly',
            '/cek-pendaftaran' => 'monthly',
            '/informasi' => 'daily',
        ];

        // 2. Dynamic Pages (Schedules)
        $schedules = Schedule::whereDate('departure_date', '>=', now())
                             ->orderBy('departure_date', 'asc')
                             ->get();

        // 3. Dynamic Pages (Articles)
        $articles = Article::published()
                           ->orderBy('published_at', 'desc')
                           ->get();

        // 4. Article Categories
        $articleCategories = ArticleCategory::whereHas('articles', function($q) {
            $q->published();
        })->get();

        $content = view('sitemap', [
            'staticPages' => $staticPages,
            'schedules' => $schedules,
            'articles' => $articles,
            'articleCategories' => $articleCategories,
        ])->render();

        return response('<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
