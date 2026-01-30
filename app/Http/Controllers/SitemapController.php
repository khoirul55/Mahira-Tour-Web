<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

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
        ];

        // 2. Dynamic Pages (Schedules)
        // Check active schedules
        // Ensure "departure_date" is a valid datetime or cast it
        $schedules = Schedule::whereDate('departure_date', '>=', now())
                             ->orderBy('departure_date', 'asc')
                             ->get();

        $content = view('sitemap', [
            'staticPages' => $staticPages,
            'schedules' => $schedules,
        ])->render();

        return response('<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
