<?php

namespace App\Helpers;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\UploadedFile;

class ImageHelper
{
    /**
     * Optimize and save image
     * 
     * @param UploadedFile $file - File yang diupload
     * @param string $folder - Folder tujuan (contoh: 'galleries', 'schedules')
     * @param int $width - Lebar target (default: 1200)
     * @param int $height - Tinggi target (default: 900)
     * @param int $quality - Quality WebP (default: 85)
     * @return string - Path file yang disimpan
     */
    public static function optimizeAndSave(
        UploadedFile $file, 
        string $folder, 
        int $width = 1200, 
        int $height = 900, 
        int $quality = 85
    ): string {
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.webp';
        $fullPath = storage_path("app/public/{$folder}/{$filename}");
        
        // Create folder if not exists
        $dir = storage_path("app/public/{$folder}");
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        
        // Optimize & save
        Image::read($file)
            ->cover($width, $height)
            ->toWebp($quality)
            ->save($fullPath);
        
        return "{$folder}/{$filename}";
    }
    
    /**
     * Delete image file
     * 
     * @param string $path - Relative path (contoh: 'galleries/123.webp')
     * @return bool
     */
    public static function deleteImage(string $path): bool
    {
        $fullPath = storage_path("app/public/{$path}");
        
        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }
        
        return false;
    }
    
    /**
     * Optimize image with custom dimensions
     * For thumbnail, profile picture, etc
     */
    public static function makeThumbnail(
        UploadedFile $file,
        string $folder,
        int $size = 300
    ): string {
        $filename = 'thumb_' . time() . '_' . uniqid() . '.webp';
        $fullPath = storage_path("app/public/{$folder}/{$filename}");
        
        $dir = storage_path("app/public/{$folder}");
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        
        Image::read($file)
            ->cover($size, $size) // Square thumbnail
            ->toWebp(80)
            ->save($fullPath);
        
        return "{$folder}/{$filename}";
    }
}