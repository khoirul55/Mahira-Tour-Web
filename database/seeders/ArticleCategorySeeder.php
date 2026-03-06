<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Info Umrah',
                'slug' => 'info-umrah',
                'description' => 'Informasi seputar umrah, persyaratan, regulasi visa, dan panduan persiapan.',
                'color' => '#001D5F',
                'icon' => 'bi-info-circle',
                'sort_order' => 1,
            ],
            [
                'name' => 'Tips Ibadah',
                'slug' => 'tips-ibadah',
                'description' => 'Tata cara thawaf, doa-doa, sunnah di Masjidil Haram dan Madinah.',
                'color' => '#10B981',
                'icon' => 'bi-book',
                'sort_order' => 2,
            ],
            [
                'name' => 'Kabar Mahira',
                'slug' => 'berita-mahira',
                'description' => 'Kabar terbaru dan update dari Mahira Tour',
                'color' => '#F59E0B',
                'icon' => 'bi-newspaper',
                'sort_order' => 3,
            ],
            [
                'name' => 'Promo & Penawaran',
                'slug' => 'promo-penawaran',
                'description' => 'Promo spesial dan penawaran paket umrah terbaru',
                'color' => '#EF4444',
                'icon' => 'bi-tag',
                'sort_order' => 4,
            ],
            [
                'name' => 'Kisah Jamaah',
                'slug' => 'kisah-jamaah',
                'description' => 'Cerita pengalaman jamaah yang telah menunaikan ibadah umrah.',
                'color' => '#8B5CF6',
                'icon' => 'bi-chat-heart',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            ArticleCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
