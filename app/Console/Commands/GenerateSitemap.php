<?php

namespace App\Console\Commands;

use App\Enums\BooleanEnum;
use App\Models\Blog;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url as SitemapUrl;

class GenerateSitemap extends Command
{
    protected $signature = 'seo:sitemap';
    protected $description = 'Generate sitemap.xml';

    public function handle(): int
    {
        // IMPORTANT: use your canonical base URL (set APP_URL in .env)
        $base = rtrim(config('app.url'), '/');

        $sitemap = Sitemap::create();

        // ---- Static pages (Blade routes) ----
        $static = [
            '/',               // home
            '/menu',
            '/about',
            '/gallery',
            '/contact',
            // add more blades here…
        ];

        foreach ($static as $path) {
            $sitemap->add(
                SitemapUrl::create($base.$path)
                   ->setLastModificationDate(CarbonImmutable::now()->startOfDay()) // or real file mtime if you track it
                   ->setChangeFrequency('monthly')
                   ->setPriority($path === '/' ? 1.0 : 0.8)
            );
        }

        // ---- Dynamic content examples ----
        // If you have models like Post, Page, Product, etc.,
        // replace with your real models/URLs.

        if (class_exists(Blog::class)) {
            Blog::query()
                            ->select(['slug','updated_at'])
                            ->where('published', BooleanEnum::ENABLE)
                            ->orderBy('id')
                            ->chunk(500, function ($posts) use ($sitemap, $base) {
                                foreach ($posts as $p) {
                                    $sitemap->add(
                                        SitemapUrl::create($base.'/blog/'.$p->slug)
                                           ->setLastModificationDate(CarbonImmutable::parse($p->updated_at)->startOfSecond())
                                           ->setChangeFrequency('weekly')
                                           ->setPriority(0.7)
                                    );
                                }
                            });
        }

        // Save to public/
        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        $this->info("✅ sitemap.xml generated at: {$path}");
        return self::SUCCESS;
    }
}
