<?php

namespace App\Helpers;

class ArticleHelper
{
    /**
     * Process all social media embeds in article body HTML.
     * Converts plain URLs (YouTube, YouTube Shorts, Instagram) into responsive embed HTML.
     */
    public static function processEmbeds(string $html): string
    {
        $html = self::processYouTubeEmbeds($html);
        $html = self::processYouTubeShortsEmbeds($html);
        $html = self::processInstagramEmbeds($html);

        return $html;
    }

    /**
     * Convert YouTube video URLs to responsive 16:9 iframe embeds.
     * 
     * Supported formats:
     * - https://www.youtube.com/watch?v=VIDEO_ID
     * - https://youtube.com/watch?v=VIDEO_ID  
     * - https://youtu.be/VIDEO_ID
     * - https://www.youtube.com/embed/VIDEO_ID (already embedded by Quill)
     */
    protected static function processYouTubeEmbeds(string $html): string
    {
        // Pattern 1: Plain YouTube URLs in text (not already in iframe/embed)
        // Matches URLs that are standalone (in <p> tags or as text nodes)
        $patterns = [
            // youtube.com/watch?v=ID (with optional params)
            '~<p>\s*(?:<a[^>]*>)?\s*(?:https?://)?(?:www\.)?youtube\.com/watch\?v=([\w-]+)(?:&[^\s<"]*)?\s*(?:</a>)?\s*</p>~i',
            // youtu.be/ID  
            '~<p>\s*(?:<a[^>]*>)?\s*(?:https?://)?youtu\.be/([\w-]+)(?:\?[^\s<"]*)?\s*(?:</a>)?\s*</p>~i',
        ];

        foreach ($patterns as $pattern) {
            $html = preg_replace_callback($pattern, function ($matches) {
                $videoId = $matches[1];
                // Skip if this is a Shorts URL (handled separately)
                if (isset($matches[0]) && stripos($matches[0], '/shorts/') !== false) {
                    return $matches[0];
                }
                return self::buildYouTubeEmbed($videoId);
            }, $html);
        }

        // Pattern 2: Quill-generated iframes — wrap them in responsive container
        $html = preg_replace_callback(
            '~<iframe\s[^>]*src=["\'](?:https?:)?//(?:www\.)?youtube\.com/embed/([\w-]+)(?:\?[^"\']*)?["\'][^>]*>\s*</iframe>~i',
            function ($matches) {
                $videoId = $matches[1];
                return self::buildYouTubeEmbed($videoId);
            },
            $html
        );

        return $html;
    }

    /**
     * Convert YouTube Shorts URLs to responsive 9:16 centered iframe embeds.
     * 
     * Supported formats:
     * - https://www.youtube.com/shorts/VIDEO_ID
     * - https://youtube.com/shorts/VIDEO_ID
     */
    protected static function processYouTubeShortsEmbeds(string $html): string
    {
        $pattern = '~<p>\s*(?:<a[^>]*>)?\s*(?:https?://)?(?:www\.)?youtube\.com/shorts/([\w-]+)(?:\?[^\s<"]*)?\s*(?:</a>)?\s*</p>~i';

        $html = preg_replace_callback($pattern, function ($matches) {
            $videoId = $matches[1];
            return self::buildYouTubeShortsEmbed($videoId);
        }, $html);

        return $html;
    }

    /**
     * Convert Instagram URLs to embed blockquotes.
     * 
     * Supported formats:
     * - https://www.instagram.com/p/POST_ID/
     * - https://www.instagram.com/reel/REEL_ID/
     * - https://instagram.com/p/POST_ID/
     * - https://instagram.com/reel/REEL_ID/
     */
    protected static function processInstagramEmbeds(string $html): string
    {
        $pattern = '~<p>\s*(?:<a[^>]*>)?\s*(?:https?://)?(?:www\.)?instagram\.com/(p|reel|reels)/([\w-]+)/?(?:\?[^\s<"]*)?\s*(?:</a>)?\s*</p>~i';

        $html = preg_replace_callback($pattern, function ($matches) {
            $type = strtolower($matches[1]);
            $postId = $matches[2];
            $isReel = in_array($type, ['reel', 'reels']);
            return self::buildInstagramEmbed($postId, $type, $isReel);
        }, $html);

        return $html;
    }

    /**
     * Build responsive YouTube 16:9 embed HTML.
     */
    protected static function buildYouTubeEmbed(string $videoId): string
    {
        return '<div class="embed-wrapper youtube">'
             . '<iframe src="https://www.youtube-nocookie.com/embed/' . e($videoId) . '?rel=0" '
             . 'title="YouTube video" '
             . 'frameborder="0" '
             . 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" '
             . 'allowfullscreen '
             . 'loading="lazy">'
             . '</iframe>'
             . '</div>';
    }

    /**
     * Build responsive YouTube Shorts 9:16 embed HTML (centered, narrow).
     */
    protected static function buildYouTubeShortsEmbed(string $videoId): string
    {
        return '<div class="embed-wrapper shorts">'
             . '<iframe src="https://www.youtube.com/embed/' . e($videoId) . '?rel=0" '
             . 'title="YouTube Shorts" '
             . 'frameborder="0" '
             . 'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" '
             . 'allowfullscreen '
             . 'loading="lazy">'
             . '</iframe>'
             . '</div>';
    }

    /**
     * Build Instagram embed HTML using official oEmbed blockquote format.
     */
    protected static function buildInstagramEmbed(string $postId, string $type, bool $isReel): string
    {
        $url = 'https://www.instagram.com/' . ($isReel ? 'reel' : 'p') . '/' . e($postId) . '/';
        $label = $isReel ? 'Instagram Reel' : 'Instagram Post';
        
        return '<div class="embed-wrapper instagram">'
             . '<blockquote class="instagram-media" '
             . 'data-instgrm-captioned '
             . 'data-instgrm-permalink="' . $url . '" '
             . 'data-instgrm-version="14" '
             . 'style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin:0 auto; max-width:540px; min-width:326px; padding:0; width:100%;">'
             . '<div style="padding:16px; text-align:center;">'
             . '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" '
             . 'style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-weight:550; text-decoration:none;">'
             . '📷 Lihat ' . $label . ' di Instagram'
             . '</a>'
             . '</div>'
             . '</blockquote>'
             . '</div>';
    }
}
