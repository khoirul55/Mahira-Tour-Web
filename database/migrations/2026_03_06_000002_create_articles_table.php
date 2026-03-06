<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Content
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');

            // Media
            $table->string('featured_image', 500)->nullable();
            $table->string('image_caption', 255)->nullable();

            // Categorization
            $table->foreignId('category_id')->constrained('article_categories')->cascadeOnDelete();
            $table->json('tags')->nullable();

            // SEO
            $table->string('meta_title', 70)->nullable();
            $table->string('meta_description', 160)->nullable();

            // Status & Publishing
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();

            // Author
            $table->foreignId('author_id')->constrained('admins')->cascadeOnDelete();

            // Analytics
            $table->unsignedInteger('views_count')->default(0);

            $table->timestamps();

            // Indexes
            $table->index(['status', 'published_at']);
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
