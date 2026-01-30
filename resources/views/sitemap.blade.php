<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Pages --}}
    @foreach($staticPages as $url => $freq)
    <url>
        <loc>{{ url($url) }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>{{ $freq }}</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Dynamic Schedules --}}
    @foreach($schedules as $schedule)
    <url>
        <loc>{{ route('schedule.detail', ['id' => $schedule->id, 'slug' => \Illuminate\Support\Str::slug($schedule->package_name)]) }}</loc>
        <lastmod>{{ $schedule->updated_at ? $schedule->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    @endforeach
</urlset>
